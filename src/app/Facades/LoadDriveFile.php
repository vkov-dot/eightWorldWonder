<?php

namespace App\Facades;

class LoadDriveFile
{
    public function downloadFile($link)
    {
        $service = GoogleDocsConsole::getService(); // Экземпляр Google_Service_Drive
        $response = $service->files->export($link, 'application/pdf', [
            'alt' => 'media'
        ]);

        dd($response);
        $content = $response->getBody()->getContents();

        return $content;
    }
}
