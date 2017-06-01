<?php
$book = filter_input(INPUT_POST, 'book', FILTER_SANITIZE_STRING);
$chapter = filter_input(INPUT_POST, 'chapter', FILTER_SANITIZE_STRING);
$verse = filter_input(INPUT_POST, 'verse', FILTER_SANITIZE_STRING);
$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);

$topics[] = filter_input(INPUT_POST, 'topics');

$dbconn = pg_connect("dbname=scripture user=postgres password=taLLr0ids*");
if (!$dbconn){
	echo "An error occurred.\n";
	exit;
}

$insertScripture = pg_query($dbconn, "INSERT INTO scripture(name, chapter, verse, content) values (:sN, :sCh, :sV, :sCo)");
$insertScripture->bind(':sN', $sN);
$insertScripture->bind(':sCh', $sCh);
$insertScripture->bind(':sV', $sV);
$insertScripture->bind(':sCo', $sCo);
if (!$insertScripture) {
	echo "An error occurred.\n";
	exit;
} else {
	echo pg_fech_row($insertScripture);
}

$insertTopic = pg_query($dbconn, "INSERT INTO scriptureTopic(scriptureId, topicId) values (:sId, :tId)");
$insertTopic->bind(':sId', $sId);
$insertTopic->bind(':tId', $tId);
if (!$insertTopic) {
	echo "An error occurred.\n";
	exit;
} else {
	echo pg_fech_row($insertTopic);
}

?>
