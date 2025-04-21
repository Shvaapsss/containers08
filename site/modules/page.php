<?php
class Page {
    private $template;

    public function __construct($tpl) {
        $this->template = file_get_contents($tpl);
    }

    public function render($data) {
        $result = $this->template;
        foreach ($data as $key => $value) {
            $result = str_replace("{{" . $key . "}}", $value, $result);
        }
        return $result;
    }
}
