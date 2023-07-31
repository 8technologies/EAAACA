<?php

namespace Modules\Media\Entities;

use Carbon\Carbon;
use Optix\Media\MediaUploader as Uploader;
use Illuminate\Http\UploadedFile;

use Intervention\Image\Exception\NotReadableException;
use Psr\Http\Message\StreamInterface;
use GuzzleHttp\Psr7\Stream;

class MediaUploader extends Uploader
{
    /** @var UploadedFile */
    protected $file;

    /** @var string */
    protected $name;

    /** @var string */
    protected $fileName;

    /** @var string */
    protected $disk;

    /** @var object */
    protected $fileCreatedAt;

    /** @var string */
    protected $fileDescription;

    /** @var string */
    protected $uploadFolder;

    /** @var string */
    protected $userId;

    /** @var array */
    protected $attributes = [];

    /**
     * Create a new uploader instance.
     *
     * @param UploadedFile $file
     * @return void
     */
    public function __construct(UploadedFile $file)
    {
        $this->setFile($file);
    }

    /**
     * @param UploadedFile $file
     * @return MediaUploader
     */
    public static function fromFile(UploadedFile $file)
    {
        return new static($file);
    }

    /**
     * Set the file to be uploaded.
     *
     * @param UploadedFile $file
     * @return MediaUploader
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        $fileName = $file->getClientOriginalName();
        $name = pathinfo($fileName, PATHINFO_FILENAME);

        $this->setName($name);
        $this->setFileName($fileName);

        return $this;
    }

    /**
     * Set the name of the media item.
     *
     * @param string $name
     * @return MediaUploader
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $name
     * @return MediaUploader
     */
    public function useName(string $name)
    {
        $extension = explode('.', $name);
        $extension = '.' . end($extension);
        $newName = str_replace($extension, '', $name);

        return $this->setName( trim(preg_replace('/[^a-zA-Z0-9\/s]+/', ' ', $newName), ' ') );    
        // return $this->setName($name);
    }

    /**
     * Set the name of the file.
     *
     * @param string $fileName
     * @return MediaUploader
     */
    public function setFileName(string $fileName)
    {
        $this->fileName = $this->sanitiseFileName($fileName);

        return $this;
    }

    /**
     * @param string $fileName
     * @return MediaUploader
     */
    public function useFileName(string $fileName)
    {
        return $this->setFileName($fileName);
    }


    /**
     * Set the description of the file.
     *
     * @param string $fileDescription
     * @return MediaUploader
     */
    public function setFileDescription(string $fileDescription)
    {
        $this->fileDescription = $fileDescription;

        return $this;
    }
    /**
     * @param string $fileDescription
     * @return MediaUploader
     */
    public function useFileDescription(string $fileDescription)
    {
        return $this->setFileDescription($fileDescription);
    }

    /**
     * Set the Upload Folder.
     *
     * @param string $uploadFolder
     * @return MediaUploader
     */
    public function setUploadFolder(string $uploadFolder)
    {
        if ($this->fileCreatedAt) {
            $fileCreatedAt = Carbon::parse($this->fileCreatedAt);
            $this->uploadFolder = $uploadFolder . $fileCreatedAt->format('/Y/m');
        } else {
            $this->uploadFolder = $uploadFolder . now()->format('/Y/m');
        }

        return $this;

        // // if ($this->fileCreatedAt) {
        // //     $fileCreatedAt = Carbon::parse($this->fileCreatedAt);
        // //     $this->uploadFolder = $uploadFolder;
        // // } else {
        // //     $this->uploadFolder = $uploadFolder;
        // // }

        // $this->uploadFolder = $uploadFolder;

        // return $this;
    }

    /**
     * Set the file_created_at of the file.
     *
     * @param string $fileDescription
     * @return MediaUploader
     */
    public function setFileCreatedAt(string $fileCreatedAt)
    {
        $this->fileCreatedAt = $fileCreatedAt;

        return $this;
    }
    /**
     * @param string $fileCreatedAt
     * @return MediaUploader
     */
    public function useFileCreatedAt(string $fileCreatedAt)
    {
        return $this->setFileCreatedAt($fileCreatedAt);
    }
    
    /**
     * @param string $uploadFolder
     * @return MediaUploader
     */
    public function useUploadFolder(string $uploadFolder)
    {
        return $this->setUploadFolder($uploadFolder);
    }

    /**
     * Set the UserId.
     *
     * @param string $userId
     * @return MediaUploader
     */
    public function setUserId(string $userId)
    {
        $this->userId = $userId;

        return $this;
    }
    /**
     * @param string $userId
     * @return MediaUploader
     */
    public function useUserId(string $userId)
    {
        return $this->setUserId($userId);
    }



    /**
     * Sanitise the file name.
     *
     * @param string $fileName
     * @return string
     */
    protected function sanitiseFileName(string $fileName)
    {
        $extension = explode('.', $fileName);
        $extension = '.' . end($extension);
        $name = str_replace($extension, '', $fileName);
        // dd( $name );
        return trim(preg_replace('/[^a-zA-Z0-9\/s]+/', '-', $name), '-') . $extension;
    }

    /**
     * Specify the disk where the file will be stored.
     *
     * @param string $disk
     * @return MediaUploader
     */
    public function setDisk(string $disk)
    {
        $this->disk = $disk;

        return $this;
    }

    /**
     * @param string $disk
     * @return String
     */
    public function useDisk(string $disk)
    {
        return $this->setDisk($disk);
    }

    /**
     * @param string $disk
     * @return MediaUploader
     */
    public function toDisk(string $disk)
    {
        return $this->setDisk($disk);
    }

    /**
     * Set any custom attributes to be saved to the media item.
     *
     * @param array $attributes
     * @return MediaUploader
     */
    public function withAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @param array $properties
     * @return MediaUploader
     */
    public function withProperties(array $properties)
    {
        return $this->withAttributes($properties);
    }

    /**
     * Upload the file to the specified disk.
     *
     * @return mixed
     */
    public function upload()
    {
        $model = config('media.model');

        $media = new $model();

        $media->name = $this->name;
        $media->file_name = $this->fileName;
        $media->disk = $this->disk ? $this->disk : config('media.disk');
        $media->mime_type = $this->file->getMimeType();
        $media->size = $this->file->getSize();
        // custom fields
        $media->file_description = $this->fileDescription;
        $media->upload_folder = $this->uploadFolder;
        $media->user_id = $this->userId;

        $media->forceFill($this->attributes);

        $media->save();

        $media->filesystem()->putFileAs(
            $media->getDirectory(),
            $this->file,
            $this->fileName
        );

        return $media->fresh();
    }
}
