<style type="text/css">
	.data-table-pagination {		
		margin-top: 20px;
		border-top: 1px solid #eee;
		padding-top: 20px;
                padding-bottom: 20px;
                padding-right: 20px;
	}
	.vuetable-pagination-info {
		font-size: 0.8rem;
		padding-bottom: 10px;
                padding-right: 20px;
	}
	/* Loading Animation: */
        .data-table {
                opacity: 1;
                position: relative;
                filter: alpha(opacity=100); /* IE8 and earlier */
        }
        .data-table.loading {
                
                opacity:0.5;
                transition: opacity .3s ease-in-out;
                -moz-transition: opacity .3s ease-in-out;
                -webkit-transition: opacity .3s ease-in-out;
        }
        .data-table.loading td {
                opacity:0.8;
        }
        .data-table.loading:after {
                position: absolute;
                content: '';
                top: 40%;
                left: 50%;
                margin: -30px 0 0 -30px;
                border-radius: 100%;
                -webkit-animation-fill-mode: both;
                        animation-fill-mode: both;
                border: 4px solid #42A5F5;
                height: 60px;
                width: 60px;
                background: transparent !important;
                display: inline-block;
                -webkit-animation: pulse 1s 0s ease-in-out infinite;
                animation: pulse 1s 0s ease-in-out infinite;
        }

        .vuetable-detail-row > td {
                border-top: 0px;
        }

        @keyframes pulse {
          0% {
            -webkit-transform: scale(0.6);
                    transform: scale(0.6); }
          50% {
            -webkit-transform: scale(1);
                    transform: scale(1);
                 border-width: 12px; }
          100% {
            -webkit-transform: scale(0.6);
                    transform: scale(0.6); }
        }
</style>