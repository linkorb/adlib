<?php

namespace AdLib\Model;

class Creative
{
    protected $name; 
    protected $type; // image
    protected $url;
    protected $targetUrl; // target url
    protected $weight; // compaired to other creatives in the same campaign
    protected $width;
    protected $height;
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
    
    public function getTargetUrl()
    {
        return $this->targetUrl;
    }
    
    public function setTargetUrl($targetUrl)
    {
        $this->targetUrl = $targetUrl;
        return $this;
    }
    
    public function getWeight()
    {
        return $this->weight;
    }
    
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }
    
    public function getWidth()
    {
        return $this->width;
    }
    
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }
    
    
    
    public function getHeight()
    {
        return $this->height;
    }
    
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }
    
    public function getHtml($fullWidth = false)
    {
        $o = '';
        $o .= "<a class=\"adlib-ad ";
        if ($fullWidth) {
            $o .= "adlib-fullwidth";
        }
        $o .= "\" border=0 href=\"" . $this->getTargetUrl() . "\">";
        $o .= "<img src=\"" . $this->getUrl() . "\"";
        $o .= " style=\"";
        if ($fullWidth) {
            $o .= " width: 100%;";
        } else {
            $o .= " width: " . $this->getWidth() . "px;";
            $o .= " height: " . $this->getHeight() . "px;";
        }
        $o .= "\" />";
        $o .= "</a>";
        return $o;
    }
}
