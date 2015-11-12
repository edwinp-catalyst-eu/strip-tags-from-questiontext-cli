<?php

// Strip HTML tags from questiontext in QT's 1 & 2

define('CLI_SCRIPT', 1);

// Run from /admin/cli dir
require_once(dirname(dirname(dirname(__FILE__))).'/config.php');

$sql = "SELECT id, questiontext
          FROM {question}
         WHERE qtype IN (?, ?)";

$questions = $DB->get_records_sql($sql, array('turmultiplechoice', 'turprove'));

foreach ($questions as $question) {
    mtrace("Changing questiontext of question id {$question->id} from '{$question->questiontext}' to '" .strip_tags($question->questiontext) . "'.");
    $question->questiontext = strip_tags($question->questiontext);
    $DB->update_record('question', $question);
}
mtrace('Fin');

