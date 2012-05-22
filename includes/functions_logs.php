<?php

class log
{
    private $handle;

    public function __construct()
    {
        global $root_path;

        $dir = scandir($root_path . 'logs/');
        array_shift($dir);
        array_shift($dir);

        $n = 1;

        foreach ($dir as $file)
        {
            if (strpos($file, date('D_d-M-Y')) !== false)
            {
                $n++;
            }
        }

        $this->handle = fopen($root_path . 'logs/' . date('D_d-M-Y') . '_' . $n . '.log', 'a');
    }

    public function add($line)
    {
        echo $line . PHP_EOL;
        fwrite($this->handle, $line . PHP_EOL);
    }

    public function spacer($type)
    {
        switch ($type)
        {
            case 1:
                $this->add('-------------------------');
            break;

            case 2:
                $this->add('|||||||||||||||||||||||||');
            break;

            default:
            case 0:
                $this->add('');
            break;
        }
    }
}