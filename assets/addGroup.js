const groups = document.getElementsByClassName('groupBtn');

for(const group of groups) {
    group.addEventListener('click', function (event) {
        event.preventDefault();

        fetch(group.getAttribute('href'))
        .then(response => {
            if(response.status != 200 ) alert("Erreur");
            
            group.classList.remove('btn-outline-primary');
            group.classList.add('btn-primary');
        })
        ;
    });
}