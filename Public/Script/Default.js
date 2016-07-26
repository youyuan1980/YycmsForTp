var setting = {
    data: {
        simpleData: {
            enable: true
        }
    }
};

$(document).ready(function () {
    $.fn.zTree.init($("#treeDemo"), setting, zNodes);
});

Ext.onReady(function () {
    Ext.state.Manager.setProvider(new Ext.state.CookieProvider());
    var viewport = new Ext.Viewport({
        layout: 'border',
        items: [
                new Ext.BoxComponent({ // raw
                    region: 'north',
                    el: 'north',
                    height: 65
                }),
                  new Ext.Panel({
                      region: 'south',
                      contentEl: 'south',
                      split: true,
                      height: 40,
                      minSize: 100,
                      maxSize: 200,
                      collapsible: true,
                      border:false,
                      margins: '0 0 0 0'
                  }),
                 {
                     region: 'west',
                     id: 'west-panel',
                     title: '功能菜单',
                     autoScroll: true,
                     split: true,
                     width: 200,
                     minSize: 175,
                     maxSize: 400,
                     collapsible: true,
                     margins: '0 0 0 5',
                     layout: 'accordion',
                     layoutConfig: {
                         animate: true
                     },
                     contentEl: 'west'
                 },
                new Ext.Panel({
                    region: 'center',
                    id: 'center',
                    contentEl: 'main'
                })
             ]
    });
});