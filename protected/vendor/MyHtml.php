<?
class MyHtml {
    public static function createBoxItemHtml($model) {
    $html = <<<HTML
        <li>{$model->balance}</li>
HTML;
        return $html;
    }
}
?>