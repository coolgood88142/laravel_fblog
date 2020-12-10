<template>
	<div id="channel_list">
		<div class="form-group" id="select">
			<table class="table table-striped table-bordered" style="width:100%">
				<tr>
					<th>ID</th>
					<th>標題</th>
					<th>文章內容</th>
					<th>網址slug</th>
					<th>編輯設定</th>
				</tr>
				<tr v-for="(articles, index) in articlesData" :key="index">
					<th>{{ articles.id }}</th>
					<th>{{ articles.title }}</th>
					<th>{{ articles.content }}</th>
					<th>{{ articles.slug }}</th>
					<td>
						<input type="button" class="btn btn-primary" value="編輯" @click="$emit('update-articles', articles.id, articles.title, articles.content, articles.slug, index)" />
						<input type="button" class="btn btn-primary" value="刪除" @click="deleteArticles(articles.id, index)" />
					</td>
				</tr>
			</table>
		</div>
		</div>
</template>

<script>
export default {
	props:{
		articlesData: {
			type:Array
		},
		url: {
			type:String
		}
	},
	data() {
		return {
			btnSelect: 'btn btn-primary',
			seleted: '',
			showData: this.articlesData
		}
	},
	methods: {
		deleteArticles(id, index) {
			let url = this.url
			let params = {
                id: id
			}
			
			axios.delete(url+"/"+id).then((response) => {
				this.$emit('delete-articles-data', index),
				this.$emit('is-show-message', true, '刪除成功!')
            }).catch((error) => {
                if (error.response) {
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                } else {
                	console.log('Error', error.message);
                }
                this.$emit('is-show-message', false, '刪除失敗!')
            })
		}
	},
}
</script>