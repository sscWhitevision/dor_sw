<?php

class RedactorMgrTranslationsProcessor extends modProcessor
{
    public function process()
    {
        $this->modx->lexicon->load('redactor:editor');

        // Automatically load all lexicon strings prefixed with redactor.lang
        $strings = $this->modx->lexicon->fetch('redactor.lang.', true);
        $strings = json_encode($strings, JSON_PRETTY_PRINT);
        header('Content-Type: application/javascript');
        @session_write_close();
        $lang = $this->modx->getOption('manager_language', $_SESSION, 'en', true);
        echo "\$R.addLang('{$lang}', {$strings});";
        exit();
    }
}
return 'RedactorMgrTranslationsProcessor';