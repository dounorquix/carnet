Ext.ns('com.quizzpot.tutorial');

grid = {
	init: function(){
		var store = new Ext.data.JsonStore({
			url: '/code3_10/entrada_productos/listar',
			root: 'data',
			totalProperty: 'total',
			fields: ['col1','col2','col3','col4','col5', 'col6','col7'],
			baseParams: {x:10, y:11}
		});
		//store.load({params:{z:10, start:0, limit:11}});
		
		var pager = new Ext.PagingToolbar({
			store: store,
			displayInfo: true,
			displayMsg: '<b>{0} - {1} de {2} Registros</b>',
			emptyMsg: '<font color="#3366699"><b>No hay registros para mostrar</b></font>',
			pageSize: 11
		});
	
		pager.on('beforechange',function(bar,params){
			params.z = 10;
		});
      
      refreshGrid = function() {
         Ext.getCmp('entrada_producto').getStore().reload();
        }
      
		var grid = new Ext.grid.GridPanel({
         id: "entrada_producto",
			store: store,
			tbar   : ['PRODUCTOS REGISTRADOS EN ESTA ENTRADA'],
			columns: [
				{header:'REF', dataIndex:'col1', width:80, align:'left'},
				{header:'PRODUCTO', dataIndex:'col2', width:250, sortable: true, align:'left'},
                                {header:'TIPO EMPLEADO', dataIndex:'col3', width:150, sortable: true, align:'left'},
                                {header:'GENERO', dataIndex:'col4', width:100, sortable: true, align:'left'},
                                {header:'TALLA', dataIndex:'col5', width:100, sortable: true, align:'left'},
                                {header:'CANTIDAD', dataIndex:'col6', width:150, sortable: true, align:'left'},
                                {header:'ACCION', dataIndex:'col7', width:100, sortable: true, align:'left'}
			],
			height:178,
			width:940,
			border: true,
			closable: false,
			stripeRows: true,
         align:'center', 
			bbar: pager
		});
		
		grid.render('frame');
	}
}
Ext.onReady(grid.init,grid);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
