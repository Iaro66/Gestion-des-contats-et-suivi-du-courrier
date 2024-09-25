function confirmUpdate() {
    var form = document.getElementById('edit-form');
    var idservice = form.nomservice.value;
    var portebatiment = form.portebatiment.value;
    var matriculeagent = form.matriculeagent.value;
    var nomdivision = form.nomdivision.value;
    var nomministere = form.nom_ministere.value;
    var nomagent = form.nomagent.value;
    var prenomagent = form.prenomagent.value;
    var telagent = form.telagent.value;
    var mailagent = form.mailagent.value;

    var message = "Confirmez-vous les modifications suivantes ?\n\n";
    message += "Service: " + idservice + "\n";
    message += "Porte du bâtiment: " + portebatiment + "\n";
    message += "Matricule: " + matriculeagent + "\n";
    message += "Division: " + nomdivision + "\n";
    message += "Responsable du Ministère: " + nomministere + "\n";
    message += "Nom: " + nomagent + "\n";
    message += "Prénom: " + prenomagent + "\n";
    message += "Téléphone: " + telagent + "\n";
    message += "E-mail: " + mailagent + "\n";

    return confirm(message);
}
