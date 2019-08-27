<template>
  <div class="container wd-100v">
      <div class="row">
      <div class="col-2">
          <p><span class="tx-bold text-underline"><u>Número</u></span></p>
          <p><span class="tx-bold"><u>Fecha de registro</u></span></p>
          <p><span class="tx-bold"><u>Estado</u></span></p>
          <p><span class="tx-bold"><u>Tipo de documento</u></span></p>
          <p><span class="tx-bold"><u>Fecha del documento</u></span></p>
      </div>
      <div class="col-2">
        <p class="tx-semibold tx-teal">{{record.number}}</p>
        <p class="tx-semibold">{{recordDate}}</p>
        <p class="tx-semibold tx-teal">{{record.status}}</p>
        <p class="tx-semibold">{{record.document_type}}</p>
        <p class="tx-semibold">{{documentDate}}</p>
      </div>
       <div class="col-1.5">
          <p><span class="tx-bold"><u>Nro. de factura</u></span></p>
          <p><span class="tx-bold"><u>Descripción</u></span></p>
          <p><span class="tx-bold"><u>Adjuntos</u></span></p>
          <p><span class="tx-bold"><u>Tercero</u></span></p>
          <p><span class="tx-bold"><u>Empleado</u></span></p>
          <p><span class="tx-bold"><u>Dependencia</u></span></p>
      </div>
        <div class="col-3">
        <p class="tx-medium">{{record.invoice_number || 'No aplica'}}</p>
        <p class="tx-medium">{{record.description}}</p>
        <p class="tx-medium">{{record.attacheds}}</p>
        <p class="tx-medium">{{record.third_party.name}}</p>
        <p class="tx-semibold tx-teal">{{recordEmployee}}</p>
        <p class="tx-medium">{{record.dependency.name}}</p>
      </div>
  </div>
  </div>
</template>

<script>
export default {
props:["record"],

computed: {
  recordDate() {
    return moment(this.record.datetime).format('DD/MM/YYYY HH:mm')
  },
  recordEmployee() { 
    return `${this.record.employee.firstname} ${this.record.employee.lastname}`
  },
  documentDate() {
    return moment(this.record.document_date).format('DD/MM/YYYY')
  }
}
}
</script>