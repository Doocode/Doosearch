/* Source : http://alistapart.com/article/accent-folding-for-auto-complete */

var accent_map = {
    'á':'a', 'à':'a', 'â':'a', 'ä':'a', 
    'é':'e', 'è':'e', 'ê':'e', 'ë':'e', 
    'í':'i', 'ì':'i', 'î':'i', 'ï':'i',
    'ó':'o', 'ò':'o', 'ô':'o', 'ö':'o',
    'ú':'u', 'ù':'u', 'û':'u', 'ü':'u'
};

function accentFold(string)
{
    if (!string)
        return '';
    
    var result = '';
    for (var i = 0; i < string.length; i++)
        result += accent_map[string.charAt(i)] || string.charAt(i);
    
    return result;
};