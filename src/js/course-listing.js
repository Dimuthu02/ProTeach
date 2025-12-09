function showCourses(category) {
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        document.getElementById('course-cont').innerHTML = xhr.responseText;
    };
    xhr.open('GET', 'course-handle.php?category=' + category, true);
    xhr.send();
}

