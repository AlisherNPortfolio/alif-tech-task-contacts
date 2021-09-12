<template>
	<div class="pagination-container">
		<paginate
			v-if="total > perPage"
			:page-count="pageCount"
			:click-handler="pagination"
			:prev-text="prevText"
			:next-text="nextText"
			:container-class="className"
			:page-class="pageClass"
			:page-range="pageRange"
			:margin-pages="marginPages"
			:first-last-button="true"
			:first-button-text="firstBtnText"
			:last-button-text="lastBtnText"
			prev-class="prev-item"
			next-class="next-item"
			prev-link-class="prev-link-item"
			next-link-class="next-link-item"
			>
		</paginate>
	</div>
</template>

<script>
import leftIco from '../../assets/icons/arrow-left-short.svg';
import leftFirstIco from '../../assets/icons/arrow-left-max.svg';

    export default {
        name: "pagination",
		props: {
            total: {
				type: Number,
				default: 0
			},
			perPage: {
				type: Number,
				default: 10
			},
			prevText: {
				type: String,
				default: `<img src="${leftIco}" alt="">`
			},
			nextText: {
				type: String,
				default: `<img src="${leftIco}" alt="">`
			},
			firstBtnText: {
				type: String,
				default: `<img src="${leftFirstIco}" alt="">`
			},
			lastBtnText: {
				type: String,
				default: `<img src="${leftFirstIco}" alt="">`
			},
			className: {
				type: String,
				default: 'pagination'
			},
			pageClass: {
				type: String,
				default: 'page-item'
			},
			marginPages: {
				type: Number,
				default: 2
			},
			pageRange: {
				type: Number,
				default: 3
			}
		},
		data() {
            return{
            	leftIcon: leftIco,
				firstIco: leftFirstIco
			}
		},
		methods: {
           pagination(page) {
				this.$emit('paginate', page);
			}
		},
		computed: {
           pageCount: function() {
				return Math.ceil(this.total / this.perPage);
			}
		}
    }
</script>

<style>
.pagination-container {
	margin-top: 20px;
}
.page-item {
	border-radius: 8px;
	border: 1px solid #E5EFF5;
	display: inline-block;
    width: 30px;
	height: 30px;
    margin-right: 5px;
	cursor: pointer;
	display: flex;
	align-items: center;
	justify-content: center;
	color: #9BB5CC !important;
}
li.page-item:last-child {
	margin-right: 0;
}
.page-item a {
	font-weight: 600;
    font-size: 14px;
}
.page-item.active {
	/* background-color: #271735; */
	color: #353C47 !important;
	border: none;
}
.page-item:hover {
	border: none;
	color: #353C47;
}
.pagination li:first-child,
.pagination li:last-child {
	font-weight: 600;
    font-size: 14px;
	display: inline-block;
    padding: 5px 13px;
    margin-right: 5px;
}

.pagination li.prev-item {
	margin-right: 15px;
}

.pagination li.next-item {
	margin-left: 15px;
}

.pagination li.next-item{
	display: flex;
	align-items: center;
}

.prev-item{
	display: flex;
	align-items: center;
}
.pagination li:last-child,
.pagination li:first-child {
	background-color: transparent;
	border: none;
}
.pagination li:last-child{
	display: flex;
	margin-right: 0;
}

.pagination li.next-item img,
.pagination li:last-child img {
	transform: rotate(180deg);
}
</style>
