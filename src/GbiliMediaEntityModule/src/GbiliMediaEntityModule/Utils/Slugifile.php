<?php
namespace GbiliMediaEntityModule\Utils;

/**
 * From some text input, try to make a valid filename
 * that can be used as a slug
 *
 * @author Gbili
 */
class Slugifile
{
    /**
     * @var 
     */
    protected $input;

    /**
     * Whether the input has been parsed
     * @var boolean
     */
    protected $isParsed;

    protected $basename;
    protected $extension;
    protected $output;

    /**
     * @param string $text
     */
    public function __constrct($text)
    {
        $this->setInput($text);
    }

    /**
     * @param string $text
     * @return self
     */
    public function setInput($text)
    {
        if (!is_string($text)) {
            throw new \Exception('Bad input, expecting string.');
        }
        $this->isParsed = false;
        $this->input = $text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInput()
    {
        return $this->input;
    }

    public function isParsed()
    {
        return $this->isParsed;
    }

    /**
     * Take apart input into logic components
     * of a filename
     */
    public function parseParts()
    {
        if ($this->isParsed()) {
            return $this;
        }

        $input = $this->getInput();
        $extensionDotPos = strrpos($input, '.');
        $this->setBasename(substr($input, 0, $extensionDotPos-1));
        $this->setExtension(substr($input, $extensionDotPos+1));

        $this->setOutput($this->getBasename() . '.' . $this->getExtension());

        $this->isParsed = true;

        return $this;
    }

    /**
     * @return self
     */
    public function setExtension($extension)
    {
        if (preg_match('/[^a-zA-Z0-9]/', $extension)) {
            throw new \Exception('Bad Extension: ' . print_r($extension, true));
        }
        $this->extension = $extension;
        $this->isParsed = false;
        return $this;
    }

    /**
     * @return self
     */
    public function setBasename($basename)
    {
        $text = $basename;
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // lowercase
        $text = strtolower($text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            $text = 'n-a';
        }
        $this->basename = $text;
        $this->isParsed = false;

        return $this;
    }

    /**
     * @return string
     */
    public function getBasename()
    {
        $this->parseParts()
        return $this->basename;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        $this->parseParts()
        return $this->extension;
    }

    /**
     * Try to create a valid filename
     * @return string valid basename: somefile-is.bz2
     */
    public function slugify()
    {
        return 
    }

    protected function setOutput($validslug)
    {
        $this->output = $validslug;
        return $this;
    }

    public function getOutput()
    {
        $this->parseParts();
        return $this->output;
    }
}
