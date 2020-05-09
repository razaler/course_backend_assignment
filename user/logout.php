<?php

SESSION_START();

SESSION_UNSET($_SESSION);

unset($_SESSION['username']);

SESSION_DESTROY();

header("Location: http://localhost/course_backend_assignment/");
