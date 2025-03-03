<?php

/**
 * This file conains helper functions for our app
 */


function escape($html)
{
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
