<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

/**
 * Imap is the model of data from mailbox.
 *
 * * @var array $titles
 */
class Imap extends Model
{  
    private $_mbox = false;

    public $date;
    public $subject;
    public $from;
    public $sender;
    public $id;

    public function __construct() 
    {
        $this->login();
    }
    // public function __destruct() 
    // {
    //     $this->logout();
    // }
    public function login()
    {
        $this->_mbox = imap_open(
            Yii::$app->params['imapHost'].'INBOX',
            Yii::$app->params['mailLogin'], 
            Yii::$app->params['mailPass']
        );
        return  ($this->_mbox)?true:false;
    }
    public function receiveMessages($start, $finish)
    {
        for ($i=$start; $i >= $finish ; $i--) {
            $header = imap_headerinfo($this->_mbox, $i);
            if (!$header) {
               return false; 
            }
            $this->date[$i]     = date('d.m.y G:i',strtotime($header->MailDate));
            $this->from[$i]     = $header->from[0]->mailbox.'@'.$header->from[0]->host;
            $this->sender[$i]   = $this->decodeMail($header->from[0]->personal);
            $this->id[$i]       = +($header->Msgno);
            $this->subject[$i]  = $this->decodeMail($header->subject);
        }
        return true;
    }
    public function logout()
    {
        imap_close($this->_mbox);
    }
    // public function logout($res)
    // {
    //     imap_close($res);
    // }
    /**
     * Возвращает количество писем во входящей папке 
     *
     * @return string/boolean  
     */
    public function getNumMsg()
    {
        return imap_num_msg($this->_mbox);
    }
    public function decodeMail($str)
    {
        $mime = imap_mime_header_decode($str);
        $item = '';
        foreach ($mime as $key => $m) {
            if (!$this->checkUtf8($m->charset)) {
                    $item .= $this->convertToUtf8($m->charset, $m->text);
            } else {
                $item .= $m->text;
            }
        }
        return $item;
    }
    public function checkUtf8($charset)
    {
        if (strtolower($charset) != 'utf-8') {
            return false;
        }
        return true;
    }
    public function convertToUtf8($in_charset, $str)
    {
        return iconv(strtolower($in_charset), 'utf-8', $str);
    }
    public function delMsg($id)
    {   
        $num = count($id);
        for ($i=0; $i < $num; $i++) { 
            imap_delete ($this->_mbox , $id[$i]);
        }
        return imap_expunge ($this->_mbox)?true:false;
    }
    public function getRes()
    {
        return $this->_mbox;
    }
}