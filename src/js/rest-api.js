"use strict";

const __root__ = "http://localhost:4000";

let elems = {
    editProfileForm: document.getElementById("edit-user-profile-form"),
    editProfileBtn: document.getElementById("btn-edit-profile"),
    editProfileLoader: document.getElementById("edit-profile-loader"),
    favouriteForm: document.getElementById("favourite-form"),
    favouriteBtn: document.getElementById("favourite-btn"),
    favouriteLoader: document.getElementById("favourite-loader"),
    adoptionRequestForm: document.getElementById("ask-for-adoption-form"),
    adoptionRequestBtn: document.getElementById("ask-for-adoption-btn"),
    adoptionRequestLoader: document.getElementById("ask-for-adoption-loader"),
    sendMessageForm: document.getElementById("send-message-form"),
    sendMessageBtn: document.getElementById("send-message-btn"),
    sendMessageLoader: document.getElementById("send-message-loader"),
    success: document.getElementById("success"),
}


/*
 * Helper Methods
 */
async function mkRequest(method, url, data) {
    let response = await fetch(url, {
        method: method,
        body: data 
    })
    
    return response;
}   

const showLoader = (elem) => {
    elem.style.display = "block";
}

const hideLoader = (elem) => {
    elem.style.display = "none";
}

const success = () => {
    elems.success.style.display = "block";

    setTimeout(() => {
        elems.success.style.display = "none";
    }, 1500);
}

/*
 * RESTful Methods
 */
async function editProfile() {
    showLoader(elems.editProfileLoader);

    // Post Request
    let formData = new FormData();

    formData.append("email", elems.editProfileForm.elements["email"].value);
    formData.append("fName", elems.editProfileForm.elements["first-name"].value);
    formData.append("lName", elems.editProfileForm.elements["last-name"].value);    
    formData.append("addr", elems.editProfileForm.elements["address"].value);    
    formData.append("zipCod", elems.editProfileForm.elements["zip-cod"].value);    
    formData.append("img", elems.editProfileForm.elements["cover-img"].files[0]);   
    
    const csrf = elems.editProfileForm.elements["csrf"].value;
    const urlPost = `${__root__}/php/actions/action_edit_profile.php?csrf=${csrf}`;

    let postResponse = await mkRequest("POST", urlPost, formData)
                                .then(res => {
                                        if (res.ok)
                                            return Promise.resolve(res);
                                        return Promise.reject(new Error('Status not OK'));
                                });
        
    console.log(postResponse.formData());
             
    // Get Request
    const urlGet = `${__root__}/php/actions/action_get_profile.php`;

    let getResponse = await fetch(urlGet)  
                                .then(res => {
                                    if (res.ok) {
                                        Promise.resolve(res);
                                        return res.json();
                                    }
                                    else 
                                        return Promise.reject(new Error('Status not OK'));
                                })
                                .then(obj => {
                                    console.log(obj);
                                    let elem;                           
                                    let fullName = "";
                                    let fullAddress = "";

                                    for (let key in obj) {
                                        switch (key) {
                                            case "email":
                                                elem = document.getElementById("user-email");
                                                elem.innerHTML = obj[key];
                                                break;
                                            case "firstName": 
                                                fullName += obj[key];
                                                break;
                                            case "lastName": 
                                                let lastName = obj[key];
                                                fullName += ` ${lastName}`;
                                                elem = document.getElementById("user-name");
                                                elem.innerHTML = fullName; 
                                                break;
                                            case "morada": 
                                                fullAddress += obj[key];
                                                break;
                                            case "zipCod": 
                                                let zipCod = obj[key];
                                                fullAddress += `, ${zipCod}`;
                                                elem = document.getElementById("user-address");
                                                elem.innerHTML = fullAddress; 
                                                break;
                                            case "coverImg":
                                                let imgUrl = obj[key];
                                                elem = document.getElementById("profile-banner");
                                                elem.style.backgroundImage = `url(../../images/users/${imgUrl})`;
                                                break;
                                            default: 
                                                continue;

                                        }
                                    }
                                });

    
    setTimeout(() => {
        hideLoader(elems.editProfileLoader);
        success();
    }, 1500);
}


async function addFavourite() {
    showLoader(elems.favouriteLoader);

    let formData = new FormData();

    formData.append("petId", elems.favouriteForm.elements["pet-id"].value);

    const csrf = elems.favouriteForm.elements["csrf"].value;
    const url = `${__root__}/php/actions/action_favourite.php?csrf=${csrf}`;

    let response = await mkRequest("POST", url, formData)
                            .then(res => {
                                    if (res.ok)
                                        return Promise.resolve(res);
                                    return Promise.reject(new Error('Status not OK'));
                            });
                        
    console.log(response.formData());

    setTimeout(() => {
        hideLoader(elems.favouriteLoader);
        success();
    }, 1500);

}


async function askForAdoption() {
    showLoader(elems.adoptionRequestLoader);

    let formData = new FormData();

    formData.append("message", elems.adoptionRequestForm.elements["message"].value);
    formData.append("petId", elems.adoptionRequestForm.elements["pet-id"].value);

    const csrf = elems.adoptionRequestForm.elements["csrf"].value;
    const url = `${__root__}/php/actions/action_ask_for_adoption.php?csrf=${csrf}`;

    let response = await mkRequest("POST", url, formData)
                            .then(res => {
                                    if (res.ok)
                                        return Promise.resolve(res);
                                    return Promise.reject(new Error('Status not OK'));
                            });

    console.log(response.formData());

    document.getElementById("message").value = "";

    setTimeout(() => {
        hideLoader(elems.adoptionRequestLoader);
        success();
    }, 1500);
}            


async function sendMessage() {
    showLoader(elems.sendMessageLoader);

    let formData = new FormData();

    formData.append("message", elems.sendMessageForm.elements["msg"].value);
    formData.append("receiverId", elems.sendMessageForm.elements["receiver-id"].value);

    const csrf = elems.sendMessageForm.elements["csrf"].value;
    const url = `${__root__}/php/actions/action_send_message.php?csrf=${csrf}`;

    let response = await mkRequest("POST", url, formData)
                            .then(res => {
                                    if (res.ok)
                                        return Promise.resolve(res);
                                    return Promise.reject(new Error('Status not OK'));
                            });

    console.log(response.formData());

    document.getElementById("message").value = "";

    setTimeout(() => {
        hideLoader(elems.sendMessageLoader);
        success();
    }, 1500);
}


/*
 * Initialize all Scripts
 */
document.addEventListener("DOMContentLoaded", (event) => {
    if (elems.editProfileForm) {
        elems.editProfileBtn.addEventListener("click", (e) => {
            e.preventDefault();
            editProfile();
        });     
    }

    if (elems.favouriteForm) {
        elems.favouriteBtn.addEventListener("click", (e) => {
            e.preventDefault();
            addFavourite();
        });
    }

    if (elems.adoptionRequestForm || elems.sendMessageForm) {
        let adoptCheckbox = document.getElementById("ask-for-adoption");

        adoptCheckbox.addEventListener("click", function() {
                if (this.checked) {
                    elems.sendMessageForm.style.display = "none";
                    elems.adoptionRequestForm.style.display = "block";
                } else {
                    elems.sendMessageForm.style.display = "block";
                    elems.adoptionRequestForm.style.display = "none";
                }
        });

        
        // adoption request
        elems.adoptionRequestBtn.addEventListener("click", (e) => {
            e.preventDefault();
            askForAdoption();
        }); 
    
        // regular message
        elems.sendMessageBtn.addEventListener("click", (e) => {
            e.preventDefault();
            sendMessage();
        });
    }
});


