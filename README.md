<h1>Coding Conventions</h1>

<code>
    public function sampleFunction($a, $b = null) {
        if ($a === $b) {
            bar();
        }
        elseif ($a > $b) {
            $foo->bar($arg1);
        }
        else {
            BazClass::bar($arg2, $arg3);
        }
    }
</code>

Please refer to https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md for more information about code style.
