# Võrgurakendused Projekt - Varakamber

Varakamber on rakendus, mille abil saab kodumajapidamises registreerida meile olulisi asju/esemeid teatud kindlates asukohtades asuvateks. Eseme nimetuse võib määrata kasutaja ise vabalt, samas kui eseme liigi ja asukoha valikud on kindlaks määratud. Lehel saab lisada uusi esemeid, muuta olemasolevaid või eemaldada esemeid varakambrist. Uue eseme lisamisel antakse automaatselt kaasa ka lisamise kuupäev. Eseme eemaldamisel kustutatakse ese olemasolevate esemete nimekirjast (andmebaasist mitte - seal märgitakse eemaldamine vastava lipuga) ja lisatakse automaatselt eemaldatud esemete nimekirja ning salvestatakse ära tema eemaldamise kuupäev. Eemaldatud esemete tabel on vaikimise varjatud, tabeli peakirja kõrval asuvast pulseerivast nupust saab sisu kuvamise sisse/välja lükata.

Varakambri kasutamiseks/testimiseks võib registreerida uue kasutaja ja logida sisse sellega või kasutada olemasolevat kasutajat admin[ät]admin.ee koos parooliga "adminadmin". Kuna hetkel on varakamber mõeldud ainult koduseks kasutamiseks, siis on kõik seal kirjas olevad esemed näha kõikidele kasutajatele. Kui tulevikus peaks tekkima vajadus luua uusi eraldi varakambreid uutele kasutajatele, siis tuleb juurde lisada kasujatepõhine varakambrite eraldamine nii sessioonide kui ka andmebaasi tasemel, et iga varakambrit näeks ainult selleks määratud kasutajad.

Tehnoloogiatest on kasutatud: HTML, PHP, http://materializecss.com/, Javascript(sh. http://www.jquery-backstretch.com/), MySQL

Kuna dokumentatsiooni, kui sellist, ei eksisteeri ja rakenduse kogu funktsionaalsuse siia kirjeldamine läheks pikaks, siis võib küsimuste tekkimisel kirjutada kairi.papstel[ät]gmail.com
