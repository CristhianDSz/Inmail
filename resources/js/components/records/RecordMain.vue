<template>
  <div class="container mt-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="text-left">
            <small class="font-weight-bold">Total radicados: 10</small>
          </div>
          <div class="text-right">
            <small class="font-weight-bold">Crear nuevo registro</small>
            <a
              href="#"
              class="btn btn-info btn-icon rounded-circle mg-r-5 mg-b-10 bd-4"
              @click.prevent="showModal"
            >
              <div>
                <i class="icon ion-plus"></i>
              </div>
            </a>
          </div>
        </div>
        <div class="pd-10 rounded mg-t-10">
          <!-- <ul
            class="nav nav-outline flex-column flex-md-row justify-content-flex-start"
            role="tablist"
          >
            <li class="nav-item" v-for="(typeRecordTab,index) in typeRecordsTabs" :key="index">
              <a
                class="nav-link"
                :class="{'active': selectedTab === typeRecordTab}"
                href="#"
                @click.prevent="selectedTab = typeRecordTab"
              >{{typeRecordTab}}</a>
            </li>
          </ul>-->
          <div class="content-tabs">
            <table class="table table-valign-middle mg-b-0">
              <tbody>
                <tr>
                  <td class="pd-l-0-force">
                    <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt />
                  </td>
                  <td>
                    <h6 class="tx-inverse tx-14 mg-b-0">Deborah Miner</h6>
                    <span class="tx-12">@deborah.miner</span>
                  </td>
                  <td>Nov 01, 2017</td>
                  <td>
                    <span id="sparkline1">
                      <canvas
                        width="100"
                        height="30"
                        style="display: inline-block; width: 100px; height: 30px; vertical-align: top;"
                      ></canvas>
                    </span>
                  </td>
                  <td class="pd-r-0-force tx-center">
                    <a href class="tx-gray-600">
                      <i class="icon ion-more tx-18 lh-0"></i>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td class="pd-l-0-force">
                    <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt />
                  </td>
                  <td>
                    <h6 class="tx-inverse tx-14 mg-b-0">Belinda Connor</h6>
                    <span class="tx-12">@belinda.connor</span>
                  </td>
                  <td>Oct 28, 2017</td>
                  <td>
                    <span id="sparkline2">
                      <canvas
                        width="100"
                        height="30"
                        style="display: inline-block; width: 100px; height: 30px; vertical-align: top;"
                      ></canvas>
                    </span>
                  </td>
                  <td class="pd-r-0-force tx-center">
                    <a href class="tx-gray-600">
                      <i class="icon ion-more tx-18 lh-0"></i>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td class="pd-l-0-force">
                    <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt />
                  </td>
                  <td>
                    <h6 class="tx-inverse tx-14 mg-b-0">Andrew Wiggins</h6>
                    <span class="tx-12">@andrew.wiggins</span>
                  </td>
                  <td>Oct 27, 2017</td>
                  <td>
                    <span id="sparkline3">
                      <canvas
                        width="100"
                        height="30"
                        style="display: inline-block; width: 100px; height: 30px; vertical-align: top;"
                      ></canvas>
                    </span>
                  </td>
                  <td class="pd-r-0-force tx-center">
                    <a href class="tx-gray-600">
                      <i class="icon ion-more tx-18 lh-0"></i>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td class="pd-l-0-force">
                    <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt />
                  </td>
                  <td>
                    <h6 class="tx-inverse tx-14 mg-b-0">Brandon Lawrence</h6>
                    <span class="tx-12">@brandon.lawrence</span>
                  </td>
                  <td>Oct 27, 2017</td>
                  <td>
                    <span id="sparkline4">
                      <canvas
                        width="100"
                        height="30"
                        style="display: inline-block; width: 100px; height: 30px; vertical-align: top;"
                      ></canvas>
                    </span>
                  </td>
                  <td class="pd-r-0-force tx-center">
                    <a href class="tx-gray-600">
                      <i class="icon ion-more tx-18 lh-0"></i>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td class="pd-l-0-force">
                    <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt />
                  </td>
                  <td>
                    <h6 class="tx-inverse tx-14 mg-b-0">Marilyn Tarter</h6>
                    <span class="tx-12">@marilyn.tarter</span>
                  </td>
                  <td>Oct 27, 2017</td>
                  <td>
                    <span id="sparkline5">
                      <canvas
                        width="100"
                        height="30"
                        style="display: inline-block; width: 100px; height: 30px; vertical-align: top;"
                      ></canvas>
                    </span>
                  </td>
                  <td class="pd-r-0-force tx-center">
                    <a href class="tx-gray-600">
                      <i class="icon ion-more tx-18 lh-0"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <modal ref="recordModal" name="recordModal">
          <template slot="title">Crear nuevo registro</template>
          <template slot="body">
            <record-form></record-form>
          </template>
        </modal>
      </div>
    </div>
  </div>
</template>

<script>
import Modal from "../utils/Modal";
import RecordForm from "./RecordForm";
export default {
  components: { Modal, RecordForm },
  data() {
    return {
      records: [],
      typeRecordsTabs: ["Entrada", "Salida"],
      selectedTab: "Entrada"
    };
  },
  created() {},
  methods: {
    showModal() {
      this.$refs.recordModal.showModal();
    }
  }
};
</script>
