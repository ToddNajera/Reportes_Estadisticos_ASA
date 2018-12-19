#!/usr/bin/env python
# -*- coding: ISO-8859-1 -*-

import wx, sys
import mod.Base as bas
import mod.Constantes as con
import mod.DButil as dbu
import mod.Dinero as din
import mod.Fechas as fec
import mod.Menus as mnu
import mod.Objetos as obj
import mod.Reportes as rep
import mod.Varios as var

def iniPrg():
    con.prg.arc = 'RepEstResultados'
    con.prg.nom = 'Reporte Estadisticos de Cuentas de Resultado'
    con.prg.ver = '1.0.5'
    con.prg.fec = '18/Dic/2016'
    con.prg.des = 'Impresión del Reporte Estadisticos de Cuentas de Resultado.'
    con.prg.com = ''
    return con.prg
    

ARC_IMPRESION = 'RepEstadoDeResultados%s(%s-%s).pdf'
SUMA_CUENTA = "_" * 14
SUMA_SUBCTA = "-" * 23
SUMA_TOTAL = "=" * 14

#OXOXOXOXOXOXOXOXOXOXOXO#  INICIO DE LA CLASE "Programa"  #OXOXOXOXOXOXOXOXOXOXOXO#

class Programa(bas.mBase):
    def __init__(self, usr, *args, **kwds):
        #kwds['style'] = wx.DEFAULT_FRAME_STYLE
        kwds['style'] = bas.WX_DEFAULT_STYLE
        self.prg = iniPrg()
        self.ejercicios = []
        wx.Frame.__init__(self, *args, **kwds)
        
        self.Globales(usr)
        self.leeOpciones()
        self.iniDatos()
        self.cfgVentana(1000, 700, 250)
        self.creaAreaDatos()
        self.creaMenu(self.Menu())
        self.creaHerramientas(self.Herramientas())
        self.creaBarraStatus()
        self.creaDistribucion()
        self.habMenuHerram(self.mn.ARCHIVO, self.op.BUSCAR, self.bh.BUSCAR)
        self.habMenuHerram(self.mn.ARCHIVO, self.op.IMPRIMIR, self.bh.IMPRIMIR, False)
        
        self.reloj = wx.PyTimer(self.actStatus)
        self.reloj.Start(1000)
        self.actStatus()
        
        self.opejercicio.Valor(0)
        self.opmes_inicial.Valor(0)
        self.opmes_final.Valor(int(fec.cFecha().mes) -1)
    
    def leeOpciones(self):
        dbs = dbu.Conexion(self.usr)
        if dbs is not None:
            cur = dbs.cursor()
            self.TipoAuxiliar = dbu.leeCatalogo(cur, 'cat_tipo_auxiliar', 'clave|nombre', 'clave', 'clave!=""')
            dbs.close()
    
    def Menu(self):
        opc = [
            ('archivo', ''),
                ('buscar', self.Buscar),
                ('separador', None),
                ('imprimir', self.Imprimir),
                ('separador', None),
                ('salir', self.Salir),
                ('finmenu', None),
            ('ayuda', ''),
                ('manual', self.Manual), ('configura', self.Configura),
                ('separador', None),
                ('acerca', self.Acerca_de),
                ('finmenu', None)
        ]
        return opc
    
    def Herramientas(self):
        bot = [
            ('buscar', self.Buscar),
            ('separador', None),
            ('imprimir', self.Imprimir),
            ('separador', None),
            ('salir', self.Salir)
        ]
        return bot
        
    def iniDatos(self):
        self.cur.execute('SELECT * FROM ejercicios ORDER BY ejercicio DESC')
        regs = dbu.Registro(self.cur)
        for r in range(regs.nn):
            regs.SetActual(r)
            self.ejercicios.append(regs.ejercicio)
        
    def creaAreaDatos(self):
        self.txejercicio = obj.Texto(self.panel, 'Ejercicio:', 70, sty='AD', pos='DER|ACV|5|0')
        self.txmes_inicial = obj.Texto(self.panel, 'Mes Inicial:', 80, sty='AD', pos='DER|ACV|5|0')
        self.txmes_final = obj.Texto(self.panel, 'Mes Final:', 80, sty='AD', pos='DER|ACV|5|0')
        self.txnivel = obj.Texto(self.panel, 'Nivel:', 50, sty='AD', pos='DER|ACV|5|0')
        
        self.opejercicio = obj.Opcion(self.panel, 70, opc=self.ejercicios, acc=self.accDatos)
        self.opmes_inicial = obj.Opcion(self.panel, 130, opc=con.MESES, pos='DER|ACV|4|0', acc=self.accDatos)
        self.opmes_final = obj.Opcion(self.panel, 130, opc=con.MESES, pos='DER|ACV|5|0', acc=self.accDatos)
        self.opnivel = obj.Opcion(self.panel, 130, opc=['CUENTA','SUBCUENTA','SUBSUBCUENTA'], pos='IZQ|ACV|5|0', acc=self.accDatos)
        self.opnivel.Valor(1)
        
        self.ldreporte = obj.Listado(self.panel, pos='TDO|EXP|1|2')
        #self.ldreporte.creaColumnas(COL)
        
    def creaDistribucion(self):
        self.txstatus.Hide()
        cjventana = obj.Caja()
        cjdatos = obj.Caja()
        
        mrejercicio = obj.Marco(self.panel)
        cjejercicio = obj.Caja('H')
        cjejercicio.AgregaLista([
            self.txejercicio, self.opejercicio, 40,
            self.txmes_inicial, self.opmes_inicial, 40,
            self.txmes_final, self.opmes_final, 40,
            self.txnivel, self.opnivel
        ])
        mrejercicio.Agrega(cjejercicio)
        
        mrreporte = obj.Marco(self.panel, pos='TDO|EXP|1|1')
        cjreporte = obj.Caja('H', pos='TDO|EXP|2|2')
        cjreporte.Agrega(self.ldreporte)
        mrreporte.Agrega(cjreporte)
        
        cjdatos.AgregaLista([mrejercicio, mrreporte])
        self.panel.SetAutoLayout(True)
        self.panel.SetSizer(cjdatos)
        cjdatos.Fit(self.panel)
        cjdatos.SetSizeHints(self.panel)
        cjventana.Add(self.panel, 1, wx.EXPAND, 0)
        self.SetAutoLayout(True)
        self.SetSizer(cjventana)
        self.Layout()
        self.Centre()
        
    def accDatos(self, evt=None):
        status = False
        if self.opejercicio.Valor() >= 0 and self.opmes_inicial.Valor() >= 0 and self.opmes_final.Valor() >= 0:
            status = True
        self.habMenuHerram(self.mn.ARCHIVO, self.op.BUSCAR, self.bh.BUSCAR, status)
        self.habMenuHerram(self.mn.ARCHIVO, self.op.IMPRIMIR, self.bh.IMPRIMIR, False)
        
    def Buscar(self, evt=None):
        ejercicio = self.opejercicio.Texto()
        mesini = self.opmes_inicial.Valor() + 1
        mesfin = self.opmes_final.Valor() + 1
        mes_inicial = str(mesini).zfill(2)
        mes_final = str(mesfin).zfill(2)
        suma_ssbcta_mes = {}
        suma_subcta_mes = {}
        suma_cuenta_mes = {}
        suma_ingreso_mes = {}
        suma_egreso_mes = {}
        sm_cuenta = '=' * 13
        sm_subcta = '-' * 22
        NIVEL = self.opnivel.Valor() + 1
        self.ldreporte.ClearAll()
        cols = [('CUENTA', 'CUENTA', 100, 'I'), ('DESCRIPCION', 'DESCRIPCION', 280, 'I')]
        for m in range(mesini, mesfin+1):
            cols.append((str(m).zfill(2), con.MESES[m-1], 100, 'D'))
            suma_ssbcta_mes[m] = din.Decimal('0.00')
            suma_subcta_mes[m] = din.Decimal('0.00')
            suma_cuenta_mes[m] = din.Decimal('0.00')
            suma_ingreso_mes[m] = din.Decimal('0.00')
            suma_egreso_mes[m] = din.Decimal('0.00')
        cols.append(('TOTAL', 'TOTAL', 100, 'D'))
        self.ldreporte.creaColumnas(cols)
        total_ssbcta = din.Decimal('0.00')
        total_subcta = din.Decimal('0.00')
        total_cuenta = din.Decimal('0.00')
        total_ingreso = din.Decimal('0.00')
        total_egreso = din.Decimal('0.00')
        INGRESO = self.TipoAuxiliar.Clave('INGRESO')
        GASTO = self.TipoAuxiliar.Clave('GASTO')
        cuenta = ''
        cuenta_anterior = ''
        subcta = ''
        subcta_anterior = ''
        tipo = ''
        tipo_anterior = INGRESO
        
        dbs = dbu.Conexion(self.usr)
        if dbs is None:
            return
        
        cur = dbs.cursor()
        s1 = 'SELECT * FROM cuentas_auxiliares WHERE tipo IN ("%s","%s") AND nivel="%d" ORDER BY tipo, auxiliar'
        #print s1 % (INGRESO, GASTO, NIVEL)
        rtbl = dbu.tblContabilidadDBS(dbs, ejercicio)
        cur.execute(s1 %(INGRESO, GASTO, NIVEL))
        raux = dbu.Registro(cur)
        if raux.nn > 0:
            progreso = obj.vProgreso(self, ' '*70, 'Buscando información.', raux.nn)
            for a in range(raux.nn):
                raux.SetActual(a)
                progreso.Update(a, raux.descripcion)
                cuenta, subcta, subsub = raux.auxiliar.split('-')
                tipo = raux.tipo
                nivel = raux.nivel
                if cuenta != cuenta_anterior:
                    cuenta_anterior = cuenta
                    rcta = dbu.ValidaDBS(dbs, 'cuentas_auxiliares', 'auxiliar', val='%s-000-0000'%cuenta, msj=False)
                    if rcta is not None:
                        descripcion = rcta.descripcion
                    else:
                        descripcion = ''
                    self.ldreporte.Nuevo()
                    if a > 0:
                        for m in range(mesini, mesfin+1):
                            mes = str(m).zfill(2)
                            self.ldreporte.Valor(self.ldreporte.diccol[mes], )
                        self.ldreporte.Valor(self.ldreporte.TOTAL, '-------------------')
                        self.ldreporte.Nuevo()
                        self.ldreporte.Valor(self.ldreporte.DESCRIPCION, 'T O T A L   D E   L A   C U E N T A')
                        for m in range(mesini, mesfin+1):
                            mes = str(m).zfill(2)
                            self.ldreporte.Valor(self.ldreporte.diccol[mes], din.DecAFmt(suma_cuenta_mes[m], '((((,(((,((&.&&)'))
                            suma_cuenta_mes[m] = din.Decimal('0.00')
                        self.ldreporte.Valor(self.ldreporte.TOTAL, din.DecAFmt(total_cuenta, '((((,(((,((&.&&)'))
                        total_cuenta = din.Decimal('0.00')
                        self.ldreporte.Nuevo()
                        
                        if tipo != tipo_anterior:
                            self.ldreporte.Nuevo()
                            for m in range(mesini, mesfin+1):
                                mes = str(m).zfill(2)
                                self.ldreporte.Valor(self.ldreporte.diccol[mes], '-------------------')
                            self.ldreporte.Valor(self.ldreporte.TOTAL, '-------------------')
                            self.ldreporte.Nuevo()
                            if tipo_anterior == INGRESO:
                                self.ldreporte.Valor(self.ldreporte.DESCRIPCION, 'T O T A L    D E    I N G R E S O S')
                                for m in range(mesini, mesfin+1):
                                    mes = str(m).zfill(2)
                                    self.ldreporte.Valor(self.ldreporte.diccol[mes], din.DecAFmt(suma_ingreso_mes[m], '((((,(((,((&.&&)'))
                                self.ldreporte.Valor(self.ldreporte.TOTAL, din.DecAFmt(total_ingreso, '((((,(((,((&.&&)'))
                            self.ldreporte.Nuevo()
                            for m in range(mesini, mesfin+1):
                                mes = str(m).zfill(2)
                                self.ldreporte.Valor(self.ldreporte.diccol[mes], )
                            self.ldreporte.Valor(self.ldreporte.TOTAL, '===========')
                            self.ldreporte.Nuevo()
                            tipo_anterior = tipo
                        
                        self.ldreporte.Nuevo()
                    self.ldreporte.Valor(self.ldreporte.CUENTA, cuenta)
                    self.ldreporte.Valor(self.ldreporte.DESCRIPCION, descripcion)
                    
                if NIVEL == 1:
                    aux = "%s-%%" %cuenta
                elif NIVEL == 2:
                    aux = "%s-%s-%%" %(cuenta, subcta)
                else:
                    aux = raux.auxiliar
                _fecini = ejercicio + '-%s-01'
                _fecfin = ejercicio + '-%s-%s'
                self.ldreporte.Nuevo()
                self.ldreporte.Valor(self.ldreporte.CUENTA, aux.replace('-%',''))
                self.ldreporte.Valor(self.ldreporte.DESCRIPCION, raux.descripcion)
                for m in range(mesini, mesfin+1):
                    mes = str(m).zfill(2)
                    fecini = _fecini % mes
                    fecfin = _fecfin %(mes, str(fec.DiasDelMes(m, int(ejercicio))))
                    s1 = 'SELECT SUM(cargo-abono) suma FROM %s WHERE auxiliar LIKE "%s" AND fecha BETWEEN "%s" AND "%s" AND numero NOT LIKE "PR%%"'
                    #print s1 % (rtbl.poliza, aux, fecini, fecfin)
                    cur.execute(s1 % (rtbl.poliza, aux, fecini, fecfin))
                    rsum = dbu.Registro(cur)
                    if rsum.suma == None:
                        rsum.suma = din.Decimal('0.00')
                    else:
                        rsum.suma = din.Decimal(rsum.suma)
                        if raux.tipo == INGRESO:
                            rsum.suma = rsum.suma * -1
                    self.ldreporte.Valor(self.ldreporte.diccol[mes], din.DecAFmt(rsum.suma, '((((,(((,((&.&&)'))
                        
                    suma_cuenta_mes[m] = suma_cuenta_mes[m] + rsum.suma
                    total_subcta = total_subcta + rsum.suma
                    total_cuenta = total_cuenta + rsum.suma
                    if raux.tipo == INGRESO:
                        suma_ingreso_mes[m] = suma_ingreso_mes[m] + rsum.suma
                        total_ingreso = total_ingreso + rsum.suma
                    else:
                        suma_egreso_mes[m] = suma_egreso_mes[m] + rsum.suma
                        total_egreso = total_egreso + rsum.suma
                        
                self.ldreporte.Valor(self.ldreporte.TOTAL, din.DecAFmt(total_subcta, '((((,(((,((&.&&)'))
                total_subcta = din.Decimal('0.00')
                    #self.ldreporte.Nuevo()
                    
            self.ldreporte.Nuevo()
            for m in range(mesini, mesfin+1):
                mes = str(m).zfill(2)
                self.ldreporte.Valor(self.ldreporte.diccol[mes], '-------------------')
            self.ldreporte.Valor(self.ldreporte.TOTAL, '-------------------')
            self.ldreporte.Nuevo()
            self.ldreporte.Valor(self.ldreporte.DESCRIPCION, 'T O T A L    D E    E G R E S O S')
            for m in range(mesini, mesfin+1):
                mes = str(m).zfill(2)
                self.ldreporte.Valor(self.ldreporte.diccol[mes], din.DecAFmt(suma_egreso_mes[m], '((((,(((,((&.&&)'))
            self.ldreporte.Valor(self.ldreporte.TOTAL, din.DecAFmt(total_egreso, '((((,(((,((&.&&)'))
            self.ldreporte.Nuevo()
            for m in range(mesini, mesfin+1):
                mes = str(m).zfill(2)
                self.ldreporte.Valor(self.ldreporte.diccol[mes], '===========')
            self.ldreporte.Valor(self.ldreporte.TOTAL, '===========')
            self.ldreporte.Nuevo()
                        
            self.ldreporte.Nuevo()
            for m in range(mesini, mesfin+1):
                mes = str(m).zfill(2)
                self.ldreporte.Valor(self.ldreporte.diccol[mes], '===========')
            self.ldreporte.Valor(self.ldreporte.TOTAL, '===========')
            self.ldreporte.Nuevo()
            self.ldreporte.Valor(self.ldreporte.DESCRIPCION, '(U T I L I D A D)    O    P E R D I D A    C O N T A B L E')
            for m in range(mesini, mesfin+1):
                mes = str(m).zfill(2)
                utilidad_mes = (suma_ingreso_mes[m] * -1) + suma_egreso_mes[m]
                self.ldreporte.Valor(self.ldreporte.diccol[mes], din.DecAFmt(utilidad_mes, '((((,(((,((&.&&)'))
            utilidad_total = (total_ingreso * -1) + total_egreso
            self.ldreporte.Valor(self.ldreporte.TOTAL, din.DecAFmt(utilidad_total, '((((,(((,((&.&&)'))
            self.ldreporte.Nuevo()
            for m in range(mesini, mesfin+1):
                mes = str(m).zfill(2)
                self.ldreporte.Valor(self.ldreporte.diccol[mes], '===========')
            self.ldreporte.Valor(self.ldreporte.TOTAL, '===========')
            
            progreso.Destroy()
            self.habMenuHerram(self.mn.ARCHIVO, self.op.BUSCAR, self.bh.BUSCAR, False)
            self.habMenuHerram(self.mn.ARCHIVO, self.op.IMPRIMIR, self.bh.IMPRIMIR)
            self.ldreporte.SetFocus()
        else:
            err = obj.vMensaje(self, 'No se encontro ninguna cuenta auxiliar.')
            err.ShowModal()
            err.Destroy()
    
    def genDato(self):
        mesini = self.opmes_inicial.Valor() + 1
        mesfin = self.opmes_final.Valor() + 1
        dato = []
        for ren in range(self.ldreporte.Renglones()):
            reng = []
            reng.append(self.ldreporte.Valor(self.ldreporte.CUENTA, ren=ren))
            reng.append(self.ldreporte.Valor(self.ldreporte.DESCRIPCION, ren=ren))
            for m in range(mesini, mesfin+1):
                mes = str(m).zfill(2)
                reng.append(self.ldreporte.Valor(self.ldreporte.diccol[mes], ren=ren))
            reng.append(self.ldreporte.Valor(self.ldreporte.TOTAL, ren=ren))
            #print reng
            dato.append(reng)
        return dato
        
    def Imprimir(self, evt=None):
        mesini = self.opmes_inicial.Valor() + 1
        mesfin = self.opmes_final.Valor() + 1
        empresa = dbu.DatosEmpresaDBS(self.dbs)
        titulo = '- REPORTE ESTADISTICO DE CUENTAS DE RESULTADOS DE %s A %s DE %s -'\
            % (self.opmes_inicial.Texto(), self.opmes_final.Texto(), self.opejercicio.Texto())
        reporte = rep.PDF(self.usr, ARC_IMPRESION, 'oficio', 'H', (1,1,1,1))
        reporte.defFuente('Helvetica', tam=8)
        reporte.defEncabezado(empresa.nombre, let='Times-Bold', tam=16)
        reporte.defEncabezado('', 2, tam=1)
        reporte.defEncabezado(titulo, 3, tam=10)
        reporte.defEncabezado('Fecha: _fecha_', 4, 'IZQ')
        reporte.defEncabezado('Pagina # _numpag_', 4, 'DER')
        
        reporte.defColumna('CUENTA', 21, 'IZQ')
        reporte.defColumna('DESCRIPCION', 73 , 'IZQ')
        for m in range(mesini, mesfin+1):
            reporte.defColumna(con.MESES[m-1], 20, 'DER')
        reporte.defColumna('TOTAL', 20, 'DER')
        
        reporte.defDatos(self.genDato())
        
        reporte.Genera()
        reporte.Imprimir()

    def Saldos(self, evt=None):
        saldos = SaldosIniciales(self.usr, self.ejercicios, None, -1, '')
        saldos.ShowModal()
        saldos.Destroy()
        
    def Suma(self, evt=None):
        sum = SumaSaldos(self.usr, self.ejercicios, None, -1, '')
        sum.ShowModal()
        sum.Destroy()
        
    def Configura(self, evt=None):
        pass


#OXOXOXOXOXOXOXOXOXOXOXO#  FIN DE LA CLASE "Programa"  #OXOXOXOXOXOXOXOXOXOXOXO#
#
#
#OXOXOXOXOXOXOXOXOXOXOXO#  INICIO DE LA CLASE "Aplicacion"  #OXOXOXOXOXOXOXOXOXOXOXO#

class Aplicacion(wx.App):
    def OnInit(self):
        wx.InitAllImageHandlers()
        con.usr.dbscon = dbu.Conexion(con.usr)
        Ventana = Programa(con.usr, None, -1, '')
        self.SetTopWindow(Ventana)
        Ventana.Show()
        return 1


#OXOXOXOXOXOXOXOXOXOXOXO#  FIN DE LA CLASE "Aplicacion"  #OXOXOXOXOXOXOXOXOXOXOXO#


if __name__ == '__main__':
    Ejecuta = Aplicacion(0)
    Ejecuta.MainLoop()


#===]  NOTAS  [===#
#
#
#

#===]  ACTUALIZACIONES  [===#
#
#  2005/09/03    1.0.0    Luis Antonio Lopez Velazquez
#
