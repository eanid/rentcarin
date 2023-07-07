@extends('default.layouts.master')

@section('css')
@include('default.layouts.partials.vuetable')
<style>
	.vr {
		margin-right: 5px;
	}
</style>
@endsection

@section('right_button')
<span class="d-none d-sm-inline">
	<a href="{{ site_url('user/new') }}" class="btn btn-primary btn-sm">
		<i data-feather="plus"></i>Add New User
	</a>
</span>
@endsection

@section('subtitle')
Manage your user here
@endsection

@section('title')
User Management
@endsection

@section('content')

<div id="app">

	<div class="row align-items-center">
		<div class="col"></div>
		<div class="col">
			<div class="col-auto ms-auto d-print-none mb-4">
				<div class="d-flex">
					<input type="search" class="form-control d-inline-block w-9 me-3" v-model="searchFor" @keyup="setFilter" placeholder="Type to search user...">
					<button class="btn btn-primary" @click="resetFilter">
						Reset Search
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="card">

		<div :class="[{'data-table': true}, loading]">
			<vuetable ref="vuetable" api-url="<?php echo site_url('user/data/') ?>" :fields="columns" pagination-path="" :sort-order="sortOrder" :per-page="perPage" :append-params="moreParams" detail-row-component="my-detail-row" @vuetable:cell-clicked="onCellClicked" @vuetable:load-success="onLoadSuccess" detail-row-transition="fade" :css="css.table" :row-class="onRowClass" track-by="id" @vuetable:pagination-data="onPaginationData" @vuetable:loading="showLoader" @vuetable:loaded="hideLoader">

				<template slot="actions" slot-scope="props">
					<div class="btn-group">
						<button class="btn btn-ghost-primary btn-sm" @click="edit(props.rowData)">Edit</button>
						<button class="btn btn-ghost-warning  btn-sm" @click="activate(props.rowData)">Toggle</button>
					</div>
				</template>

			</vuetable>
		</div>

		<div class="data-table-pagination mt-20 text-end">
			<vuetable-pagination-info ref="paginationInfo" :info-template="paginationInfoTemplate">
			</vuetable-pagination-info>
			<vuetable-pagination ref="pagination" @vuetable-pagination:change-page="onChangePage" :css="css.pagination">
			</vuetable-pagination>
		</div>

	</div>
</div>


@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/vue@2.7.14"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vuetable-2@next"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection

@section('js_init')
<script type="text/x-template" id="expandtemplate">

	<div class="row row-xs">
		<div class="col-lg-2"></div>
		<div class="col-lg-3">
			<div class="card">
				<div class="card-header">
					<h5>Groups</h5>
				</div>
				<div class="card-body">
					<span v-for="group in rowData.groups" class="badge bg-green-lt vr">
						@{{ group.description }}
					</span>
				</div>
			</div>
		</div>
	</div>

</script>

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
			columns: [{
					name: 'id',
					title: '<span class="lnr lnr-menu"></span>',
					//sortField: 'problems.id',
					formatter: (value, vuetable) => {
						let icon = vuetable.isVisibleDetailRow(value) ? "down" : "right";
						return [
							'<a class="show-detail-row">',
							'<span class="lnr lnr-chevron-' + icon + '"></span>',
							"</a>"
						].join('');
					}
				},
				// {
				// 	name: 'username',
				// 	title: 'Username',
				// 	sortField: 'username'
				// },

				{
					name: 'email',
					title: 'Email',
					sortField: 'email'
				},

				{
					name: 'first_name',
					title: 'Name',
					sortField: 'first_name'
				},			
				{
					name: 'active',
					title: 'Active',
				},

				{
					name: 'last_login',
					title: 'Last Login',
				},


				{
					name: 'actions',
					title: 'Actions',
				}
			],
			moreParams: [],
			sortOrder: [{
				field: 'users.id',
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
					pageClass: "btn btn-outline-light",
					linkClass: "btn btn-outline-light",
					icons: {
						first: "lnr lnr-arrow-left",
						prev: "lnr lnr-chevron-left",
						next: "lnr lnr-chevron-right",
						last: "lnr lnr-arrow-right"
					}
				}
			},
			//paginationComponent: 'vuetable-pagination',
			perPage: 30,
			paginationInfoTemplate: '<strong>Showing record</strong> {from} to {to} from {total} item(s)',

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

			enumval(value) {
				return value == '0' ?
					'<span class="badge badge-danger">No</span>' :
					'<span class="badge badge-primary">Yes</span>'
			},

			edit(rowData) {
				location.href = '{{ site_url("user/edit/") }}' + rowData.id
			},

			activate(rowData) {
				axios.get("{{ site_url('user/activate/') }}" + rowData.id)
					.then(response => {
						vm.$refs.vuetable.reload()
					})
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