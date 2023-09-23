<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    use HasFactory;

    protected $table = 'anexos';    

    protected $fillable = [
        'hashftp',
        'nome',
        'localizacao',
        'interacaoID',
    ];

    protected $dates = [
        'created_at', 
        'updated_at',
    ];    

    public function interacao()
    {
        return $this->belongsTo(Interacao::class);
    }

    private function mime_type_support($filename) {

        $idx = explode( '.', $filename );
        $count_explode = count($idx);
        $idx = strtolower($idx[$count_explode-1]);

        $browser_support =[ 
        'text/plain',
        'text/html',
        'text/css',
        'text/javascript',
        'text/xml',
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp',
        'image/svg+xml',
        'audio/mpeg',
        'audio/wav',
        'audio/ogg',
        'video/mp4',
        'video/webm',
        'video/ogg',
        'application/json',
        'application/xml',
        'application/pdf',
        'application/javascript',
        'application/octet-stream',
        'font/woff',
        'font/woff2',
        'font/trueType',
        'font/opentype',
        'multipart/form-data',
        'application/x-www-form-urlencoded',
        'application/xhtml+xml',
        'application/rss+xml',
        'application/atom+xml'];
    
        $mimet = array(
            'txt' => 'text/plain',
            'sql' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',
    
            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
    
            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',
    
            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',
    
            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',
    
            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            'docx' => 'application/msword',
            'xlsx' => 'application/vnd.ms-excel',
            'pptx' => 'application/vnd.ms-powerpoint',
    
            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );
    
        return (isset( $mimet[$idx] ) && (in_array($mimet[$idx],$browser_support)));
    }      

    public function soVisualizar(){        
        $pathToFile = $this->localizacao . $this->hashftp;
        return ($this->mime_type_support($pathToFile));
    } 
}
