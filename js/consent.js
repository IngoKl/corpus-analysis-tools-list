var cookieconsent = initCookieConsent();
document.body.classList.toggle('c_darkmode');

cookieconsent.run({
    current_lang : 'en',
    onAccept : function(){

        if(cookieconsent.allowedCategory('analytics_cookies')) {
            // Matomo
            cookieconsent.loadScript('../js/matomo.js', function(){		
            });
        }    

    },

    languages : {
        en : {
            consent_modal : {
                title :  "I use cookies",
                description :  'This website uses analytics cookies (Matomo) to enhance your experience in the future. You can change the cookie settings right here.',
                primary_btn: {
                    text: 'Accept',
                    role: 'accept_all'  //'accept_selected' or 'accept_all'
                },
                secondary_btn: {
                    text : 'Settings',
                    role : 'settings'   //'settings' or 'accept_necessary'
                }
            },
            settings_modal : {
                title : 'Cookie settings',
                save_settings_btn : "Save settings",
                accept_all_btn : "Accept all",
                blocks : [
                    {
                        title : "Cookie usage",
                        description: 'Your cookie usage disclaimer'
                    },
                    {
                        title : "Analytics Cookies (Matomo)",
                        description: 'These cookies are used to gather basic usage statistics on visitors using Matomo. The data is stored and processed locally.',
                        toggle : {
                            value : 'analytics_cookies',
                            enabled : true,
                            readonly: false
                        }
                    },
                ]
            }
        }
    }
});