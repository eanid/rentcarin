@extends('default.layouts.master')

@section('css')
@include('default.layouts.partials.vuetable')
@include('default.layouts.partials.validation')
@endsection

@section('subtitle')
Manage Group Here
@endsection

@section('title')
Groups
@endsection

@section('content')

<div class="row row-cards" id="app">

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="processForm" id="form">

                    <input type="hidden" name="ID" v-model="groupID">

                    <div class="mb-3">
                        <label class="form-label">Group Name</label>
                        <input type="text" name="group_name" v-model="groupName" :readonly="readonly"
                            class="form-control" placeholder="Group Name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Group Description</label>
                        <textarea name="description" v-model="groupDescription" class="form-control" rows="3"
                            placeholder="Description"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" @click="clearForm">Clear</button>

                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">


        <div class="row align-items-center">
            <div class="col"></div>
            <div class="col">
                <div class="col-auto ms-auto d-print-none mb-4">
                    <div class="d-flex">
                        <input type="search" class="form-control d-inline-block w-9 me-3" v-model="searchFor"
                            @keyup="setFilter" placeholder="Type to search group...">
                        <button class="btn btn-primary" @click="resetFilter">
                            Reset Search
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">

            <div :class="[{'data-table': true}, loading]">
                <vuetable ref="vuetable" api-url="<?php echo site_url('groups/data/'); ?>" :fields="columns" pagination-path="" :sort-order="sortOrder" :per-page="perPage" :append-params="moreParams"
                    @vuetable:cell-clicked="onCellClicked" @vuetable:load-success="onLoadSuccess"
                    detail-row-transition="fade" :css="css.table" :row-class="onRowClass" track-by="id"
                    @vuetable:pagination-data="onPaginationData" @vuetable:loading="showLoader"
                    @vuetable:loaded="hideLoader">

                    <template slot="actions" slot-scope="props">
                        <div class="btn-group">
                            <button class="btn btn-ghost-primary btn-sm" @click="edit(props.rowData)">Edit</button>
                        </div>
                    </template>

                </vuetable>
            </div>

            <div class="data-table-pagination mt-20 text-center">
                <vuetable-pagination-info ref="paginationInfo" :info-template="paginationInfoTemplate">
                </vuetable-pagination-info>
                <vuetable-pagination ref="pagination" @vuetable-pagination:change-page="onChangePage"
                    :css="css.pagination">
                </vuetable-pagination>
            </div>

        </div>
    </div>


</div>

@endsection

@section('js')
<script src="{{ base_url('tabler') }}/dist/js/parsley.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.7.14"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vuetable-2@next"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection

@section('js_init')
<script>
Vue.component('my-detail-row', {
    template: '#expandtemplate',
    props: {
        rowData: {
            type: Object,
            required: true
        }
    },
    methods: {
        onClick(event) {
            console.log('my-detail-row: on-click', event.target)
        },
    },
    filters: {
        formatNumber(value) {
            if (value == null) return ''
            return $.number(value, 0)
        },
        formatFloat(value) {
            if (value == null) return ''
            return $.number(value, 2)
        },
        formatDate(value, fmt) {
            if (value == null) {
                return ''
            } else {
                fmt = (typeof fmt == 'undefined') ? 'D MMM YYYY' : fmt
                return moment(value, 'YYYY-MM-DD').format(fmt)
            }
        },
        enumval(value) {
            return value == '0' ?
                '<span class="badge badge-danger">No</span>' :
                '<span class="badge badge-primary">Yes</span>'
        },
    }
})

Vue.use(Vuetable);
var vm = new Vue({
    el: '#app',
    data: {
        loading: '',
        searchFor: '',
        groupID: '',
        groupName: '',
        groupDescription: '',
        readonly: false,
        columns: [

            {
                name: 'id',
                title: 'ID',
                sortField: 'id'
            },

            {
                name: 'name',
                title: 'Name',
                sortField: 'name'
            },

            {
                name: 'description',
                title: 'Description',
            },

            {
                name: 'actions',
                title: 'Actions',
            }
        ],
        moreParams: [],
        sortOrder: [{
            field: 'name',
            direction: 'asc'
        }],
        css: {
            table: {
                tableWrapper: 'nganu',
                tableClass: 'table table-vcenter card-table',
                ascendingIcon: 'lnr lnr-chevron-up',
                descendingIcon: 'lnr lnr-chevron-down',
                detailRowClass: 'detail-row mt-5',
            },
            pagination: {
                wrapperClass: "btn-group",
                activeClass: "active",
                disabledClass: "disabled",
                pageClass: "btn btn-ghost-primary btn-sm",
                linkClass: "btn btn-ghost-primary btn-sm",
                icons: {
                    first: "lnr lnr-arrow-left",
                    prev: "lnr lnr-chevron-left",
                    next: "lnr lnr-chevron-right",
                    last: "lnr lnr-arrow-right"
                }
            }
        },
        //paginationComponent: 'vuetable-pagination',
        perPage: 10,
        paginationInfoTemplate: '<strong>Record</strong> {from} to {to} of {total} item(s)',

    },

    mounted() {
        $('#form').parsley()
    },

    methods: {

        setFilter() {
            this.moreParams = {
                'filter': this.searchFor
            }
            this.$nextTick(function() {
                this.$refs.vuetable.refresh()
            })
        },

        clearForm() {
            this.groupID = '',
			this.groupName = '',
			this.groupDescription = '',
			this.readonly = false
        },

        processForm() {
            var form = $('#form')
            var formData = new FormData(form[0])

            $.blockUI({
                message: '<div class="spinner-border text-light"></div>',
                overlayCSS: {
                    backgroundColor: '#1b2024',
                    opacity: 0.8,
                    zIndex: 1200,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    color: '#fff',
                    padding: 0,
                    zIndex: 1201,
                    backgroundColor: 'transparent'
                }
            });

            axios({
                    method: 'post',
                    url: "{{ site_url('groups/create' ) }}",
                    data: formData,
                })
                .then(function(resp) {
                    $.unblockUI()
                    swal.fire({
                        title: resp.data.response.title,
                        text: resp.data.response.message,
                        icon: resp.data.response.type,
                        onClose: function() {
                            form[0].reset()
                            vm.$refs.vuetable.reload()							
                        }
                    })
					vm.clearForm()

                })
                .catch(function(resp) {
                    console.log(resp)
                })
        },

        formatDate(value, fmt) {
            if (value == null) return ''
            fmt = (typeof fmt == 'undefined') ? 'D MMM YYYY' : fmt
            return moment(value, 'YYYY-MM-DD').format(fmt)
        },
        formatNumber(value, fmt) {
            if (value == null) return ''
            return $.number(value, fmt)
        },

        resetFilter() {
            this.searchFor = ''
            this.setFilter()
            this.sortOrder[0].field = 'id'
            this.sortOrder[0].direction = 'asc'
        },

        showLoader() {
            this.loading = 'loading'
        },
        hideLoader() {
            this.loading = ''
        },

        edit(rowData) {
            this.groupID = rowData.id
            this.groupName = rowData.name
            this.groupDescription = rowData.description
            this.readonly = true
        },

        onPaginationData(tablePagination) {
            this.$refs.paginationInfo.setPaginationData(tablePagination)
            this.$refs.pagination.setPaginationData(tablePagination)
        },
        onChangePage(page) {
            console.log(page)
            this.$refs.vuetable.changePage(page)
        },

        onInitialized(fields) {
            console.log('onInitialized', fields)
            this.vuetableFields = fields
        },

        onCellClicked(data, field, event) {
            console.log('cellClicked: ', data.data.id)
            this.$refs.vuetable.toggleDetailRow(data.data.id)
        },

        onLoadSuccess(response) {
            //console.log('Loaded: ', response)
            //this.$refs.vuetable.showDetailRow()
        },

        onDataReset() {
            console.log('onDataReset')
            this.$refs.paginationInfo.resetData()
            this.$refs.pagination.resetData()
        },

        onRowClass(dataItem, index) {
            //return (dataItem.task_type_raw === 'ipp') ? 'table-info' : 'table-warning'
        }

    },

})
</script>
@endsection