<?php

function to_money($number) {
    return number_format($number, 2, ',', '.');
}