<?php

namespace My\Infrastructure\Apis;

use Dupot\StaticManagementFramework\Page\PageAbstract;

class ConvertApi extends PageAbstract
{

    const SCRIPT = 'Scripts/convertImageBackgroundToTransparent.py';
    const DEST_PATH = 'pictures';

    protected $log;

    public function log($text)
    {
        $this->log .= $text . "\n";
    }

    public function convert()
    {


        if (!$this->getRequest()->isMethodPost()) {
            json_encode('Only post expected !!');
        }

        $rawImage = $_POST['image'];

        $rawImageList = explode(',', $rawImage);

        $imageContent = base64_decode($rawImageList[1]);

        $originFilename = '/tmp/maPhoto' . date('YmdHis') . '.jpg';

        $this->log('try write ' . $originFilename);

        file_put_contents($originFilename, $imageContent);

        $this->log('try remove background  ' . $originFilename);

        $imagePath = $this->removeBackgroundForImage($originFilename);




        $response = (object)[
            'imagePath' => $imagePath,
            'log' => $this->log
        ];

        echo json_encode($response);


        //$username = $this->getRequest()->getPostParam('username');
    }

    protected function removeBackgroundForImage($tmpOriginImagePath)
    {

        $tmpFilenameWithoutBackground = $tmpOriginImagePath . ".transparent.png";


        $command = 'python3 ';
        $command .=  __DIR__ . '/../' .  self::SCRIPT;
        $command .= ' ';
        $command .= $tmpOriginImagePath;
        $command .= ' ';
        $command .= $tmpFilenameWithoutBackground;

        $this->log($command);
        exec($command . ' 2>&1 | tee /tmp/debugSomeFile.txt ');


        $command2 = 'mv ' . $tmpFilenameWithoutBackground . ' ' . __DIR__ . '/../../../public/' . self::DEST_PATH;
        $this->log($command2);

        exec($command2);


        return self::DEST_PATH . '/' . basename($tmpFilenameWithoutBackground);
    }
}
