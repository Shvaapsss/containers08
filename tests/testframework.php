<?php
function assertExpression($expression, $success, $fail) {
    if ($expression) {
        echo "[PASS] $success\n";
        return true;
    } else {
        echo "[FAIL] $fail\n";
        return false;
    }
}
