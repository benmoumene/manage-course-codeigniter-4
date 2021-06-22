function displayNotif(posX, posY, langs) {
    let brownElement = document.createElement('div');
    brownElement.style.backgroundColor = "#9e895a";
    brownElement.style.display = "block";
    brownElement.style.width = "100%";
    brownElement.style.height = "7px";
    let root_notif = document.createElement('div');
    root_notif.style.borderRadius = "10px";
    root_notif.style.backgroundColor = 'white';
    let body = `<div style="padding:5px;border:2px #9e895a solid;border-radius:10px">${brownElement.outerHTML}<div><h6>${langs.message}</h6><div><div style="display:flex;justify-content:flex-end;"><button id="btncancel" class="btn btn-default" name="no" value="${langs.no}">${langs.no}</button><button id="btncontinue" class="btn btn-primary" name="yes" value="${langs.yes}">${langs.yes}</button></div></div>`;
    root_notif.innerHTML = body;
    console.log(brownElement.outerHTML);
    root_notif.style.position = "absolute";
    root_notif.style.top = posY+"px";
    root_notif.style.left = posX+"px";
    document.body.appendChild(root_notif);
    let exitOnClick = (e)=>{console.log(root_notif.getBoundingClientRect());
           console.log(e);
           let boundingClient = root_notif.getBoundingClientRect();
           if(e.clientX < boundingClient.left || e.clientX >= boundingClient.width + boundingClient.left || e.clientY < boundingClient.top || e.clientY > boundingClient.height + boundingClient.top) {
                //Click en dehors de la fenetre
                document.body.removeChild(root_notif);
                window.removeEventListener('click', exitOnClick);
           }
    }

    
    window.addEventListener('click', exitOnClick);
    document.getElementById('btncancel').addEventListener('click', (e)=>{document.body.removeChild(root_notif);
    window.removeEventListener('click', exitOnClick)});
    document.getElementById('btncontinue').addEventListener('click', (e)=>{window.location = langs.url});
}