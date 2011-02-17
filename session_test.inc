<?php

if (!isset($_SESSION))
{
echo "Session not started";
}

elseif (isset($_SESSION))
{
echo "Session is started";
}

?>