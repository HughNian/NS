<?php
class ThumbGd
{
    private $src = null;
    private $dest = null;
    private $forceWidth = 1024;
    private $forceHeight = 1024;
    private $format = 'png';
    private $quality = 80;
    private $srcWidth = null;
    private $srcHeight = null;
    private $destWidth = null;
    private $destHeight = null;
    private $srcExt = null;
    private $srcImageType = null;
    
    public function __construct($source='', $dest='', $forceWidth=1024, $forceHeight=1024, $format="png", $quality = 80)
    {
        if ($source)      $this->setSource($source);
        if ($dest)        $this->setDest($dest);
        if ($forceWidth)  $this->setDestWidth($forceWidth);
        if ($forceHeight) $this->setDestHeight($forceHeight);
        if ($format)      $this->setFormat($format);
        if ($quality)     $this->setQuality($quality);
    }
    
    public function setSource($src)
    {
        $this->src = $src;
        $this->loadSrcInfo();
        return $this;
    }
    
    public function getSource()
    {
        return $this->src;
    }
    
    public function setDest($dest)
    {
        $this->dest = $dest;
        return $this;
    }
    
    public function getDest()
    {
        return $this->dest;
    }
    
    public function setDestWidth($width)
    {
        if (!is_numeric($width) || $width <= 0) {
            throw new InvalidArgumentException("The width of destination image must be an integer and greater than 0");
        }
        $this->forceWidth = $width;
        return $this;
    }
    
    public function getDestWidth()
    {
        return $this->forceWidth;
    }
    
    public function setDestHeight($height)
    {
        if (!is_numeric($height) || $height <= 0) {
            throw new InvalidArgumentException("The height of destination image must be an integer and greater than 0");
        }
        $this->forceHeight = $height;
        return $this;
    }
    
    public function getDestHeight()
    {
        return $this->forceHeight;
    }
    
    public function setFormat($format='png')
    {
        if (!is_string($format) || (($format = strtolower($format)) && in_array($format, array('png', 'jpg', 'gif')) === false)) {
            throw new InvalidArgumentException("The format of destination image must be png, jpg or gif");
        }
        $this->format = $format;
        return $this;
    }
    
    public function getFormat()
    {
        return $this->format;
    }
    
    public function setQuality($quality)
    {
        if (!is_numeric($quality)) {
            throw new InvalidArgumentException("The quality of destination image must be an integer and greater than 0");
        }
        $quality = intval($quality);
        if ($quality <= -100 || $quality > 100 || $quality == 0) {
            $quality = 80;
        } elseif ($quality < 0) {
            $quality = 100 + $quality;
        }
        $this->quality = $quality;
        return $this;
    }
    
    public function getQuality()
    {
        return $this->quality;
    }
    
    /**
     * 
     * 生成缩略图 ...
     */
    public function makeThumb()
    {
        if(!file_exists($this->src)) {
            throw new RuntimeException("Cannot find source file addressed by: " . $this->src);
        }
        if($this->srcWidth <= $this->forceWidth && $this->srcHeight <= $this->forceHeight && strtoupper($this->srcExt) == strtoupper($this->format)) {
            copy($this->src, $this->dest);
            return 0;
        }
        $this->calcDimension();
        $im_src = $this->loadImResource();
        $im_dest = imagecreatetruecolor($this->destWidth, $this->destHeight);
        $bgcolor = imagecolorallocate($im_dest, 255, 255, 255);
        imagefilledrectangle($im_dest, 0, 0, $this->destWidth, $this->destHeight, $bgcolor);
        imagecopyresampled($im_dest, $im_src, 0, 0, 0, 0, $this->destWidth, $this->destHeight, $this->srcWidth, $this->srcHeight);
        switch($this->format) {
            case 'png':
                imagepng($im_dest, $this->dest);
            break;
            case 'gif':
    	        imagegif($im_dest, $this->dest);
            break;
            case 'jpg':
            default:
                imagejpeg($im_dest, $this->dest, $this->quality);
            break;
        }
        imagedestroy($im_dest);
        return 0;
    }
    
    public function getDestFileSize()
    {
        if (!file_exists($this->dest)) {
            return 0;
        }
        return filesize($this->dest);
    }
    
    private function loadSrcInfo()
    {
        list($this->srcWidth, $this->srcHeight, $this->srcImageType) = getimagesize($this->src);
        $oSource = new SplFileInfo($this->src);
        $this->srcExt = $oSource->getExtension();
        unset($oSource);
    }
    
    private function calcDimension()
    {
        if ($this->srcWidth / $this->srcHeight > $this->forceWidth / $this->forceHeight) {
            if ($this->srcWidth > $this->forceWidth) {
            	$this->destWidth = $this->forceWidth;
            } else {
            	$this->destWidth = $this->srcWidth;
            }
            $this->destHeight = $this->destWidth * $this->srcHeight / $this->srcWidth;
        } else {
        	if ($this->srcHeight > $this->forceWidth) {
        		$this->destHeight = $this->forceHeight;
        	} else {
        		$this->destHeight = $this->srcHeight;
        	}
            $this->destWidth = $this->destHeight * $this->srcWidth / $this->srcHeight;
        }
    }
    
    private function loadImResource()
    {
        $im = null;
        switch ($this->srcImageType) {
            case 2:
    	        $im = @imagecreatefromjpeg($this->src);
    	        !$im && $im = imagecreatefromgif($this->src);
            break;
            case 1:
    	        $im = imagecreatefromgif($this->src);
            break;
            case 3:
    	        $im = imagecreatefrompng($this->src);
            break;
            case 6:
                $im = BmpGd::imagecreatefrombmp($this->src);
            break;
        }
        if (is_null($im)) {
            throw new RuntimeException("Unsupported image resource type.");
        }
        return $im;
    }
}