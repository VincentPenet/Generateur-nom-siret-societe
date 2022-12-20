const nom_societe = document.querySelector('#nom_societe');

const numero_siret = document.querySelector('#numero_siret')

const champ_societe = document.querySelector('#champ_societe');

const champ_siret = document.querySelector('#champ_siret')


nom_societe.addEventListener('click', () => {

    champ_societe.select();

    navigator.clipboard.writeText(champ_societe.value);

    document.getElementById("errornamesociete").classList.remove('invisible');
    document.getElementById('errornamesociete').classList.add('visible');
    document.getElementById('errornamesociete').innerHTML = "Élément copié";
    document.getElementById('errornamesociete').classList.add('p-2');
    if (document.getElementById("errornamesiret").classList.contains('visible')) {
        document.getElementById("errornamesiret").classList.remove('visible');
        document.getElementById('errornamesiret').classList.add('invisible');
    }
})

numero_siret.addEventListener('click', () => {

    champ_siret.select();

    navigator.clipboard.writeText(champ_siret.value);

    document.getElementById("errornamesociete").classList.remove('visible');
    document.getElementById('errornamesociete').classList.add('invisible');
    document.getElementById("errornamesiret").classList.remove('invisible');
    document.getElementById('errornamesiret').classList.add('visible');
    document.getElementById('errornamesiret').innerHTML = "Élément copié";
    document.getElementById('errornamesiret').classList.add('p-2');
    if (document.getElementById("errornamesociete").classList.contains('visible')) {
        document.getElementById("errornamesociete").classList.remove('visible');
        document.getElementById('errornamesociete').classList.add('invisible');
    }
})
