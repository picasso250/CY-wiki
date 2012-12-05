for(var i = 0; i < 3; i++) { var scriptId = 'u' + i; window[scriptId] = document.getElementById(scriptId); }

$axure.eventManager.pageLoad(
function (e) {

});
document.getElementById('u0_img').tabIndex = 0;

u0.style.cursor = 'pointer';
$axure.eventManager.click('u0', function(e) {

if (true) {

	self.location.href=$axure.globalVariableProvider.getLinkUrl('index.html');

}
});
gv_vAlignTable['u1'] = 'center';u2.tabIndex = 0;

u2.style.cursor = 'pointer';
$axure.eventManager.click('u2', function(e) {

if (true) {

	self.location.href=$axure.globalVariableProvider.getLinkUrl('my.html');

}
});
gv_vAlignTable['u2'] = 'top';