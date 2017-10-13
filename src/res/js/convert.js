/* Ce fichier contient tout les fonctions de conversions */

function hexToRgba(hexColor) // Permet de convertir une couleur en HEXA vers RGBA
{
    var c;
    if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hexColor)){
        c= hexColor.substring(1).split('');
        if(c.length== 3){
            c= [c[0], c[0], c[1], c[1], c[2], c[2]];
        }
        c= '0x'+c.join('');
        return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',1)';
    }
    throw new Error('Bad Hex');
}

function rgbaToArray(rgbaColor) // Sert à tranformer une couleur RGBA en tableau
{
    rgbaColor = rgbaColor.replace('rgba(','');
    rgbaColor = rgbaColor.replace(')','');
    return rgbaColor.split(",");
}

function hexToArray(hexColor) // Passer une couleur HEXA en tableau
{
    return rgbaToArray(hexToRgba(hexColor));
}

function componentToHex(c)
{
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}

function rgbToHex(r,g,b) // Obtenir une couleur HEXA depuis un RGB
{
    return '#' + componentToHex(r) + componentToHex(g) + componentToHex(b);
}