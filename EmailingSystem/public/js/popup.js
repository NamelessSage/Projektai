function closeForm() {
    location.reload();
    document.getElementById("popup").style.display = "none";
    document.getElementById("revealb").style.display = 'block';
    document.getElementById("sendb").style.display = 'none';
}

function updateValue(id) {
    document.getElementById("idvalue").value = id;
    document.getElementById("popup").style.display = "block";
}

function openFormMarking() {
    document.getElementById("revealb").style.display = 'none';
    document.getElementById("sendb").style.display = 'block';
    var x = document.getElementsByClassName('markingForm');
    var y = document.getElementsByClassName('btn btn-primary siuntimas');
    for (var i = 0; i < x.length; i++) {
        y[i].style.display = 'none'
        x[i].style.display = "block"
    }
}

function markedForm() {
    updateValue(-1)
}

function repeatChange() {
    var repeat = document.getElementById('repeat').value
    var frequency = document.getElementById('frequency')
    var length = document.getElementById('length')
    if (repeat == "repeat") {
        frequency.style.display = 'block'
        length.style.display = 'block'
    } else {
        frequency.style.display = 'none'
        length.style.display = 'none'
    }
}

function dateSelected() {
    document.getElementById('repeat').style.display = 'block'
    document.getElementById('repeat_label').style.display = 'block'
}


