<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

use Optix\Media\Models\Media as OptixMedia;
use Optix\Media\ImageManipulator;
use Illuminate\Support\Facades\Auth;
use Nicolaslopezj\Searchable\SearchableTrait;
use EloquentFilter\Filterable;

class Media extends OptixMedia
{
    use HasFactory;
    use Filterable;
    use SearchableTrait;

    public static function boot()
    {
        parent::boot();
        
        static::deleted(function($model){
            $model->filesystem()->deleteDirectory(
                $model->getDirectory()
            );
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'file_name', 
        'disk', 
        'mime_type', 
        'size', 
        'file_description', 
        'upload_folder', 
        'user_id', 
        'created_at',
        'updated_at', 
        'deleted_at'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'file_size', 
        'file_icon', 
        'entity_links',
        'thumbnail',
        'file_url',
        'download_link',
    ];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * @var array
         */
        'columns' => [
            'media.name' => 10,
            'media.file_name' => 10,
            'media.disk' => 7,
            'media.mime_type' => 10,
            'media.size' => 5,
            'media.file_description' => 8,
            'media.upload_folder' => 8,
        ],
    ];

    /**
     * The relationships
     *
     */
    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * Get the thumbnail.
     *
     * @return string
     */
    public function getThumbnailAttribute()
    {
        if ($this->getTypeAttribute() == 'image') {
            return $this->getUrl('thumb');
        }
        return;
    }

    /**
     * Get the thumbnail.
     *
     * @return string
     */
    public function getFileThumbnailAttribute()
    {
        if ($this->getTypeAttribute() == 'image') {
            return $this->getUrl('thumb');
        }
        return;
    }

    /**
     * Get the file preview.
     *
     * @param string $conversion
     * @return mixed
     */
    public function getFilePreviewAttribute()
    {
        if ($this->getTypeAttribute() == 'image') {
            return $this->getUrl('preview');
        }
        return;
    }

    /**
     * Get the file preview.
     *
     * @return string
     */
    public function getFileIconAttribute()
    {
        switch ($this->getTypeAttribute()) {
            case 'image':
                return "fa fa-file-image";
                break;
            case 'video':
                return "fa fa-video";
                break;
            case 'text':
                return "fa fa-file";
                break;
            case 'audio':
                return "fa fa-music";
                break;
            
            default:
                return "fa fa-file";
                break;
        }
        return $this->getTypeAttribute();
    }

    // Media Overriden Functions

    /**
     * Get the url to the file.
     *
     * @param string $conversion
     * @return mixed
     */
    public function getUrl(string $conversion = '')
    {
        if ($conversion != '') {

            $disk = $this->disk;
            $path = $this->getPath($conversion);
            $exists = Storage::disk($disk)->exists($path);


	        if (! $this->isOfType('image') || str_contains($this->file_name, 'svg')) {
	            return null;
	        }

            $this->performConversions($conversion);
        }

        $fileUrl = $this->filesystem()->url($this->getPath($conversion));

        // if (!file_exists($fileUrl) && $this->isOfType('image')) {
        //     return url('/') . '/images/image-not-found.jpg';
        // }

        return $fileUrl; 
    }

    /**
     * Get the full path to the file.
     *
     * @param string $conversion
     * @return mixed
     */
    public function getFullPath(string $conversion = '')
    {
        if ($conversion != '') {
            $disk = $this->disk;
            $path = $this->getPath($conversion);
            $exists = Storage::disk($disk)->exists($path);

            if ($exists != True) {
                $this->performConversions($conversion);
            }
        }

        $fileUrl = $this->filesystem()->path($this->getPath($conversion));

        // if (!file_exists($fileUrl) && $this->isOfType('image')) {
        //     return url('/') . '/images/image-not-found.jpg';
        // }

        return $fileUrl; 
    }

    /**
     * Get the path to the file on disk.
     *
     * @param string $conversion
     * @return string
     */
    public function getPath(string $conversion = '')
    {
        $directory = $this->getDirectory();

        if ($conversion) {
            $directory .= '/conversions/'.$conversion;
        }

        return $directory.'/'.$this->file_name;
    }

    /**
     * Get the directory for files on disk.
     *
     * @return mixed
     */
    public function getDirectory()
    {
        // return $this->getKey();
        // $uploadDirectory = $this->created_at->format('/Y/m/') . sha1($this->getKey());
        $uploadDirectory = '/' . $this->getKey();

        if ($this->disk == 'private') {
            $uploadDirectory = '/' . sha1($this->getKey());
        }

        // dd( $this->getKey() );
        
        if (isset($this->upload_folder)) {
            // return $this->uploadfolder . $uploadDirectory;
            // return $this->upload_folder . '/' . $this->getKey();
            return $this->upload_folder . $uploadDirectory;
        }

        return $this->getKey();
    }









    // Custom methods

    /**
     * Get the url to the file.
     *
     * @param string $conversion
     * @return mixed
     */
    public function getFileUrlAttribute()
    {
        return $this->getUrl();
    }

    /**
     * Perform mising conversions.
     *
     * @return Filesystem
     */
    public function performConversions($conversion)
    {
    	$filePath = $this->getPath();
    	$fileExists = $this->filesystem()->exists($filePath);

        if (!$fileExists) {
            return false;
        }

        $media = $this;
        $conversions = array($conversion);

        app(ImageManipulator::class)->manipulate(
            $media, $conversions
        );
    }

    // /**
    //  * Get the file's download link.
    //  *
    //  * @return Download link
    //  */
    // public function getDownloadLink()
    // {
    //     if($this->disk == 'public') {
    //         return env('APP_URL') . '/download/storage/' . $this->getPath();
    //     }

    //     return Storage::disk($this->disk)->getConfig()->get('url') . '/download/' . $this->getPath();
    // }

    /**
     * Get the file's download link.
     *
     * @return Download link
     */
    public function getDownloadLinkAttribute()
    {
        // dump( env('APP_URL') . '/storage/' . $this->getPath() . '?action=download' );
        // dd($this->disk);

        if($this->disk == 'public') {
            return env('APP_URL') . '/storage/' . $this->getPath() . '?action=download';
        }

        return Storage::disk($this->disk)->getConfig()->get('url') . '/' . $this->getPath() . '?action=download';
    }

    /**
     * Get the file size.
     *
     * @return human readable file size
     */
    public function getFileSizeAttribute()
    {
        $bytes = $this->size;
        $precision = 2; 

        $unit = ["B", "KB", "MB", "GB"];
        $exp = floor(log($bytes, 1024)) | 0;
        return round($bytes / (pow(1024, $exp)), $precision). ' ' . $unit[$exp]; 
    }

    /**
     * Get Model Links.
     *
     * @param  null
     * @return array
     */
    public function getEntityLinksAttribute()
    {
        $links = [
            'url'  => route('dashboard.media.files.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.media.files.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.media.files.edit', [$this->attributes['id']]),
        ];

        return $links;
    }

    /**
     * Get User Entity Permissions.
     *
     * @param  string  $value
     * @return array
     */
    public function getEntityPermissionsAttribute($value)
    {
        $permissions = array();

        $permissions['view'] = Auth::user()->can('view', $this) ? true : false;
        $permissions['edit'] = Auth::user()->can('update', $this) ? true : false;
        $permissions['delete'] = Auth::user()->can('delete', $this) ? true : false;

        return $permissions;
    }

    /**
     * Model Filter Class.
     */
    public function modelFilter()
    {
        return $this->provideFilter(\Modules\Media\ModelFilters\EntityFilter::class);
    }

    protected static function newFactory()
    {
        return \Modules\Media\Database\factories\MediaFactory::new();
    }
}
