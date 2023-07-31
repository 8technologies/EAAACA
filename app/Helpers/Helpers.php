<?php

use Illuminate\Support\Facades\Auth;

function checkAjaxJsonRequest($request)
{
    if($request->wantsJson() || $request->ajax() && !$request->header('x-inertia'))
    {
        return true;
    }
    return false;
}




function syncTags($entity, $tags) {

    foreach($tags as $key => $tag) {
        // Check if tag exists
        $term = \Modules\Taxonomy\Entities\TaxonomyTerm::
            where('id', $tag)
            ->orWhere('name', $tag)
            ->first();
        
        // if tag doesn't exist, create it and replace with new item id
        if (!$term) {
            $tags[$key] = \Modules\Taxonomy\Entities\TaxonomyTerm::create(
                [
                    'name' => $tag,
                    'user_id' => Auth::user()->id,
                    'taxonomy_type_id' => 1,
                ]
            )->id;
        } else {
            $tags[$key] = $term->id;
        }
    }

    return $entity->tags()->sync($tags);
}

function getAdministrators()
{
    // Get all Users with Maintainer Role
    return \App\Models\User::whereHas('roles', function($query){
        $query->where('name', 'Administrator');
    })->get();
}

function getUnAuthorizedAccessMessage($method = null)
{
    if ($method == null) {
        return 'You are not authorized to access this page';
    }

    switch ($method) {
        case 'viewAny':
            return 'You are not authorized to access this page';
            break;
        case 'create':
            return 'You are not authorized to add a new item';
            break;

        case 'view':
            return 'You are not authorized to view this item';
            break;

        case 'update':
            return 'You are not authorized to update this item';
            break;
            
        case 'delete':
            return 'You are not authorized to delete this item';
            break;
        default:
            return 'You are not authorized to access this page';
            break;
    }
}

function searchArray($array, $key, $value)
{
    return array_search($value, array_column($array, $key)) ;
}

function getLayoutColumnRelationships()
{
    return [
        'media',
        'fieldTitles',
        'fieldTexts',
        'fieldLinks',
        'fieldImages',
        'fieldImages.media',
        'fieldHtmls',
        'fieldBlocks',
        'fieldBlocks.block',
    ];
}

function getLayoutRowRelationships()
{
    return [
        'layoutColumns',
        'layoutColumns.media',
        'layoutColumns.fieldTitles',
        'layoutColumns.fieldTexts',
        'layoutColumns.fieldLinks',
        'layoutColumns.fieldImages',
        'layoutColumns.fieldImages.media',
        'layoutColumns.fieldHtmls',
        'layoutColumns.fieldBlocks',
    ];
}

function getLayoutSectionRelationships()
{
    return [
        'media_videos',
        'media_videos.media',
        'layoutRows',
        'layoutRows.layoutColumns',
        'layoutRows.layoutColumns.media',
        'layoutRows.layoutColumns.fieldTitles',
        'layoutRows.layoutColumns.fieldTexts',
        'layoutRows.layoutColumns.fieldLinks',
        'layoutRows.layoutColumns.fieldImages',
        'layoutRows.layoutColumns.fieldImages.media',
        'layoutRows.layoutColumns.fieldHtmls',
        'layoutRows.layoutColumns.fieldBlocks',
        'fieldBlocks',
        'fieldBlocks.block',
    ];
}

function getLayoutSectionTopRelationships()
{
    return [
        'media_videos',
        'media_videos.media',
        'layoutRows',
        'layoutRows.layoutColumns',
        'layoutRows.layoutColumns.media',
        'layoutRows.layoutColumns.fieldTitles',
        'layoutRows.layoutColumns.fieldTexts',
        'layoutRows.layoutColumns.fieldLinks',
        'layoutRows.layoutColumns.fieldImages',
        'layoutRows.layoutColumns.fieldImages.media',
        'layoutRows.layoutColumns.fieldHtmls',
        'layoutRows.layoutColumns.fieldBlocks',
        'fieldBlocks',
        'fieldBlocks.block',
    ];
}

function getPageLayoutSectionRelationships()
{
    return [
        'layoutSections', 
        'layoutSections.media',
        'layoutSections.media_videos',
        'layoutSections.media_videos.media',
        'layoutSections.layoutRows',
        'layoutSections.layoutRows.layoutColumns',
        'layoutSections.layoutRows.layoutColumns.media',
        'layoutSections.layoutRows.layoutColumns.fieldTitles',
        'layoutSections.layoutRows.layoutColumns.fieldTexts',
        'layoutSections.layoutRows.layoutColumns.fieldLinks',
        'layoutSections.layoutRows.layoutColumns.fieldImages',
        'layoutSections.layoutRows.layoutColumns.fieldImages.media',
        'layoutSections.layoutRows.layoutColumns.fieldHtmls',
        'layoutSections.layoutRows.layoutColumns.fieldBlocks',
        'layoutSections.fieldBlocks',
        'layoutSections.fieldBlocks.block',
    ];
}

function getPageLayoutSectionTopRelationships()
{
    return [
        'layoutSectionTops', 
        'layoutSectionTops.media',
        'layoutSectionTops.media_videos',
        'layoutSectionTops.media_videos.media',
        'layoutSectionTops.layoutRows',
        'layoutSectionTops.layoutRows.layoutColumns',
        'layoutSectionTops.layoutRows.layoutColumns.media',
        'layoutSectionTops.layoutRows.layoutColumns.fieldTitles',
        'layoutSectionTops.layoutRows.layoutColumns.fieldTexts',
        'layoutSectionTops.layoutRows.layoutColumns.fieldLinks',
        'layoutSectionTops.layoutRows.layoutColumns.fieldImages',
        'layoutSectionTops.layoutRows.layoutColumns.fieldImages.media',
        'layoutSectionTops.layoutRows.layoutColumns.fieldHtmls',
        'layoutSectionTops.layoutRows.layoutColumns.fieldBlocks',
        'layoutSectionTops.fieldBlocks',
        'layoutSectionTops.fieldBlocks.block',
    ];
}

function getMimeTypeCategory($mimeType)
{
    // Separete mime type by "/"
    $mimeTypeArray = explode("/", $mimeType);

    // switch depending on first mime type
    switch ($mimeTypeArray[0]) {
    	case 'application':
    		// check the application type
    		return checkMimeApplicationType($mimeType);
    		break;

    	case 'text':
    		// if text, check text type
    		return checkMimeApplicationType($mimeType);
    		break;

    	default:
    		return $mimeTypeArray[0];
    		break;
    }
}

function checkMimeApplicationType($mimeType)
{
	// get mime extension
	$mimeExtension = mime2ext($mimeType);

	// Check if file is a document
	$isDocument = checkIfDocument($mimeExtension);

	if ($isDocument == true) {
		return 'document';
	}

	return explode("/", $mimeType)[0];
}

function checkIfDocument($mimeExtension)
{
	$extensionsList = [
		'doc', 'docx', 'xl', 'xls', 'xlsx', 'txt', 'tiff', 'pdf', 'ppt', 'pptx', 'rtf', 'rtx'
	];

	return in_array($mimeExtension, $extensionsList);
}

function mime2ext($mimeType) {
    $mime_map = [
        'video/3gpp2'                                                               => '3g2',
        'video/3gp'                                                                 => '3gp',
        'video/3gpp'                                                                => '3gp',
        'application/x-compressed'                                                  => '7zip',
        'audio/x-acc'                                                               => 'aac',
        'audio/ac3'                                                                 => 'ac3',
        'application/postscript'                                                    => 'ai',
        'audio/x-aiff'                                                              => 'aif',
        'audio/aiff'                                                                => 'aif',
        'audio/x-au'                                                                => 'au',
        'video/x-msvideo'                                                           => 'avi',
        'video/msvideo'                                                             => 'avi',
        'video/avi'                                                                 => 'avi',
        'application/x-troff-msvideo'                                               => 'avi',
        'application/macbinary'                                                     => 'bin',
        'application/mac-binary'                                                    => 'bin',
        'application/x-binary'                                                      => 'bin',
        'application/x-macbinary'                                                   => 'bin',
        'image/bmp'                                                                 => 'bmp',
        'image/x-bmp'                                                               => 'bmp',
        'image/x-bitmap'                                                            => 'bmp',
        'image/x-xbitmap'                                                           => 'bmp',
        'image/x-win-bitmap'                                                        => 'bmp',
        'image/x-windows-bmp'                                                       => 'bmp',
        'image/ms-bmp'                                                              => 'bmp',
        'image/x-ms-bmp'                                                            => 'bmp',
        'application/bmp'                                                           => 'bmp',
        'application/x-bmp'                                                         => 'bmp',
        'application/x-win-bitmap'                                                  => 'bmp',
        'application/cdr'                                                           => 'cdr',
        'application/coreldraw'                                                     => 'cdr',
        'application/x-cdr'                                                         => 'cdr',
        'application/x-coreldraw'                                                   => 'cdr',
        'image/cdr'                                                                 => 'cdr',
        'image/x-cdr'                                                               => 'cdr',
        'zz-application/zz-winassoc-cdr'                                            => 'cdr',
        'application/mac-compactpro'                                                => 'cpt',
        'application/pkix-crl'                                                      => 'crl',
        'application/pkcs-crl'                                                      => 'crl',
        'application/x-x509-ca-cert'                                                => 'crt',
        'application/pkix-cert'                                                     => 'crt',
        'text/css'                                                                  => 'css',
        'text/x-comma-separated-values'                                             => 'csv',
        'text/comma-separated-values'                                               => 'csv',
        'application/vnd.msexcel'                                                   => 'csv',
        'application/x-director'                                                    => 'dcr',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'   => 'docx',
        'application/x-dvi'                                                         => 'dvi',
        'message/rfc822'                                                            => 'eml',
        'application/x-msdownload'                                                  => 'exe',
        'video/x-f4v'                                                               => 'f4v',
        'audio/x-flac'                                                              => 'flac',
        'video/x-flv'                                                               => 'flv',
        'image/gif'                                                                 => 'gif',
        'application/gpg-keys'                                                      => 'gpg',
        'application/x-gtar'                                                        => 'gtar',
        'application/x-gzip'                                                        => 'gzip',
        'application/mac-binhex40'                                                  => 'hqx',
        'application/mac-binhex'                                                    => 'hqx',
        'application/x-binhex40'                                                    => 'hqx',
        'application/x-mac-binhex40'                                                => 'hqx',
        'text/html'                                                                 => 'html',
        'image/x-icon'                                                              => 'ico',
        'image/x-ico'                                                               => 'ico',
        'image/vnd.microsoft.icon'                                                  => 'ico',
        'text/calendar'                                                             => 'ics',
        'application/java-archive'                                                  => 'jar',
        'application/x-java-application'                                            => 'jar',
        'application/x-jar'                                                         => 'jar',
        'image/jp2'                                                                 => 'jp2',
        'video/mj2'                                                                 => 'jp2',
        'image/jpx'                                                                 => 'jp2',
        'image/jpm'                                                                 => 'jp2',
        'image/jpeg'                                                                => 'jpeg',
        'image/pjpeg'                                                               => 'jpeg',
        'application/x-javascript'                                                  => 'js',
        'application/json'                                                          => 'json',
        'text/json'                                                                 => 'json',
        'application/vnd.google-earth.kml+xml'                                      => 'kml',
        'application/vnd.google-earth.kmz'                                          => 'kmz',
        'text/x-log'                                                                => 'log',
        'audio/x-m4a'                                                               => 'm4a',
        'application/vnd.mpegurl'                                                   => 'm4u',
        'audio/midi'                                                                => 'mid',
        'application/vnd.mif'                                                       => 'mif',
        'video/quicktime'                                                           => 'mov',
        'video/x-sgi-movie'                                                         => 'movie',
        'audio/mpeg'                                                                => 'mp3',
        'audio/mpg'                                                                 => 'mp3',
        'audio/mpeg3'                                                               => 'mp3',
        'audio/mp3'                                                                 => 'mp3',
        'video/mp4'                                                                 => 'mp4',
        'video/mpeg'                                                                => 'mpeg',
        'application/oda'                                                           => 'oda',
        'audio/ogg'                                                                 => 'ogg',
        'video/ogg'                                                                 => 'ogg',
        'application/ogg'                                                           => 'ogg',
        'application/x-pkcs10'                                                      => 'p10',
        'application/pkcs10'                                                        => 'p10',
        'application/x-pkcs12'                                                      => 'p12',
        'application/x-pkcs7-signature'                                             => 'p7a',
        'application/pkcs7-mime'                                                    => 'p7c',
        'application/x-pkcs7-mime'                                                  => 'p7c',
        'application/x-pkcs7-certreqresp'                                           => 'p7r',
        'application/pkcs7-signature'                                               => 'p7s',
        'application/pdf'                                                           => 'pdf',
        'application/octet-stream'                                                  => 'pdf',
        'application/x-x509-user-cert'                                              => 'pem',
        'application/x-pem-file'                                                    => 'pem',
        'application/pgp'                                                           => 'pgp',
        'application/x-httpd-php'                                                   => 'php',
        'application/php'                                                           => 'php',
        'application/x-php'                                                         => 'php',
        'text/php'                                                                  => 'php',
        'text/x-php'                                                                => 'php',
        'application/x-httpd-php-source'                                            => 'php',
        'image/png'                                                                 => 'png',
        'image/x-png'                                                               => 'png',
        'application/powerpoint'                                                    => 'ppt',
        'application/vnd.ms-powerpoint'                                             => 'ppt',
        'application/vnd.ms-office'                                                 => 'ppt',
        'application/msword'                                                        => 'doc',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
        'application/x-photoshop'                                                   => 'psd',
        'image/vnd.adobe.photoshop'                                                 => 'psd',
        'audio/x-realaudio'                                                         => 'ra',
        'audio/x-pn-realaudio'                                                      => 'ram',
        'application/x-rar'                                                         => 'rar',
        'application/rar'                                                           => 'rar',
        'application/x-rar-compressed'                                              => 'rar',
        'audio/x-pn-realaudio-plugin'                                               => 'rpm',
        'application/x-pkcs7'                                                       => 'rsa',
        'text/rtf'                                                                  => 'rtf',
        'text/richtext'                                                             => 'rtx',
        'video/vnd.rn-realvideo'                                                    => 'rv',
        'application/x-stuffit'                                                     => 'sit',
        'application/smil'                                                          => 'smil',
        'text/srt'                                                                  => 'srt',
        'image/svg+xml'                                                             => 'svg',
        'application/x-shockwave-flash'                                             => 'swf',
        'application/x-tar'                                                         => 'tar',
        'application/x-gzip-compressed'                                             => 'tgz',
        'image/tiff'                                                                => 'tiff',
        'text/plain'                                                                => 'txt',
        'text/x-vcard'                                                              => 'vcf',
        'application/videolan'                                                      => 'vlc',
        'text/vtt'                                                                  => 'vtt',
        'audio/x-wav'                                                               => 'wav',
        'audio/wave'                                                                => 'wav',
        'audio/wav'                                                                 => 'wav',
        'application/wbxml'                                                         => 'wbxml',
        'video/webm'                                                                => 'webm',
        'audio/x-ms-wma'                                                            => 'wma',
        'application/wmlc'                                                          => 'wmlc',
        'video/x-ms-wmv'                                                            => 'wmv',
        'video/x-ms-asf'                                                            => 'wmv',
        'application/xhtml+xml'                                                     => 'xhtml',
        'application/excel'                                                         => 'xl',
        'application/msexcel'                                                       => 'xls',
        'application/x-msexcel'                                                     => 'xls',
        'application/x-ms-excel'                                                    => 'xls',
        'application/x-excel'                                                       => 'xls',
        'application/x-dos_ms_excel'                                                => 'xls',
        'application/xls'                                                           => 'xls',
        'application/x-xls'                                                         => 'xls',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'         => 'xlsx',
        'application/vnd.ms-excel'                                                  => 'xlsx',
        'application/xml'                                                           => 'xml',
        'text/xml'                                                                  => 'xml',
        'text/xsl'                                                                  => 'xsl',
        'application/xspf+xml'                                                      => 'xspf',
        'application/x-compress'                                                    => 'z',
        'application/x-zip'                                                         => 'zip',
        'application/zip'                                                           => 'zip',
        'application/x-zip-compressed'                                              => 'zip',
        'application/s-compressed'                                                  => 'zip',
        'multipart/x-zip'                                                           => 'zip',
        'text/x-scriptzsh'                                                          => 'zsh',
    ];

    return isset($mime_map[$mimeType]) === true ? $mime_map[$mimeType] : false;
}




function getAvatarConfig()
{
    /*
     * Set specific configuration variables here
     */
    return [

        /*
        |--------------------------------------------------------------------------
        | Image Driver
        |--------------------------------------------------------------------------
        | Avatar use Intervention Image library to process image.
        | Meanwhile, Intervention Image supports "GD Library" and "Imagick" to process images
        | internally. You may choose one of them according to your PHP
        | configuration. By default PHP's "Imagick" implementation is used.
        |
        | Supported: "gd", "imagick"
        |
        */
        'driver'    => 'gd',

        // Initial generator class
        'generator' => \Laravolt\Avatar\Generator\DefaultGenerator::class,

        // Whether all characters supplied must be replaced with their closest ASCII counterparts
        'ascii'    => false,

        // Image shape: circle or square
        'shape' => 'square',

        // Image width, in pixel
        'width'    => 320,

        // Image height, in pixel
        'height'   => 320,

        // Number of characters used as initials. If name consists of single word, the first N character will be used
        'chars'    => 2,

        // font size
        'fontSize' => 24,

        // convert initial letter in uppercase
        'uppercase' => true,

        // Right to Left (RTL)
        'rtl' => false,

        // Fonts used to render text.
        // If contains more than one fonts, randomly selected based on name supplied
        'fonts'    => [__DIR__.'/../fonts/OpenSans-Regular.ttf', __DIR__.'/../fonts/rockwell.ttf'],

        // List of foreground colors to be used, randomly selected based on name supplied
        'foregrounds'   => [
            '#FFFFFF',
        ],

        // List of background colors to be used, randomly selected based on name supplied
        'backgrounds'   => [
            '#f44336',
            '#E91E63',
            '#9C27B0',
            '#673AB7',
            '#3F51B5',
            '#2196F3',
            '#03A9F4',
            '#00BCD4',
            '#009688',
            '#4CAF50',
            '#8BC34A',
            '#CDDC39',
            '#FFC107',
            '#FF9800',
            '#FF5722',
        ],

        'border'    => [
            'size'  => 0,

            // border color, available value are:
            // 'foreground' (same as foreground color)
            // 'background' (same as background color)
            // or any valid hex ('#aabbcc')
            'color' => 'background',

            // border radius, only works for SVG
            'radius' => 0,
        ],

        // List of theme name to be used when rendering avatar
        // Possible values are:
        // 1. Theme name as string: 'colorful'
        // 2. Or array of string name: ['grayscale-light', 'grayscale-dark']
        // 3. Or wildcard "*" to use all defined themes

        'theme' => ['colorful'],

        // Predefined themes
        // Available theme attributes are:
        // shape, chars, backgrounds, foregrounds, fonts, fontSize, width, height, ascii, uppercase, and border.
        'themes' => [
            'grayscale-light' => [
                'backgrounds' => ['#edf2f7', '#e2e8f0', '#cbd5e0'],
                'foregrounds' => ['#a0aec0'],
            ],
            'grayscale-dark' => [
                'backgrounds' => ['#2d3748', '#4a5568', '#718096'],
                'foregrounds' => ['#e2e8f0'],
            ],
            'colorful' => [
                'backgrounds' => [
                    '#f44336',
                    '#E91E63',
                    '#9C27B0',
                    '#673AB7',
                    '#3F51B5',
                    '#2196F3',
                    '#03A9F4',
                    '#00BCD4',
                    '#009688',
                    '#4CAF50',
                    '#8BC34A',
                    '#CDDC39',
                    '#FFC107',
                    '#FF9800',
                    '#FF5722',
                ],
                'foregrounds' => ['#FFFFFF'],
            ],
        ]
    ];

}
