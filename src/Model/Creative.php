<?php

namespace AdLib\Model;

class Creative
{
    protected $name;
    protected $type; // image
    protected $url;
    protected $text;
    protected $targetUrl; // target url
    protected $weight; // compaired to other creatives in the same campaign
    /*
    protected $width;
    protected $height;
    */

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

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    /*
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
    */



    public function getHtml($fullWidth = false)
    {
        $o = '<div class="ads">';
        $o .= '<div class="row">';
        $o .= '<div class="col-md-6">';

        $o .= "<a class=\"xadlib-ad ";
        if ($fullWidth) {
            $o .= "xadlib-fullwidth";
        }
        $o .= "\" xborder=0 href=\"" . $this->getTargetUrl() . "\">";
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
        $o .= '</div><div class="col-md-6">';
        if ($this->getText()) {
            $o .= '<div class="ad-text">';
            $lines = explode("<br>", $this->getText());

            $first = true;
            foreach ($lines as $line) {
                if ($first) {
                    $o .= '<b>' . trim($line, "# ") . '</b>';
                    $first = false;
                } else {
                    $o .= $line;
                }
                $o .= "<br />\n";
            }
            $o .= '</div>';
        }
        $o .= '</div>';
        $o .= '</div>';
        $o .= '</div>';
        //$o .= $this->getText();
        return $o;
    }
}
