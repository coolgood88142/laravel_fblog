<template>
	<transition name="modal">
		<div class="modal-mask">
			<div class="modal-wrapper">
				<div class="modal-container">
					<form action="" method="POST" class="sidebar-form">
						<div class="modal-header">
							<slot name="header">
								<h3>{{ editTitle }}</h3>
							</slot>
						</div>
						<div class="modal-body">
							<slot name="body">
								<div class="form-group">
									<label for="inputTitle">標題</label>
									<input type="text" class="form-control" id="inputTitle" v-model="title">
								</div>
								<div class="form-group">
									<label for="inputContent">內容</label>
									<input type="text" class="form-control" id="inputContent" v-model="content">
								</div>
								<div class="form-group">
									<label for="inputSlug">網址 slug</label>
									<input type="text" class="form-control" id="inputSlug" v-model="slug">
								</div>
							</slot>
						</div>
						<div class="modal-footer">
							<slot name="footer">
								<div class="form-check form-check-inline">
									<input type="button" class="btn btn-primary" id="cancel" name="cancel"
											value="取消" @click="$emit('close')">
								</div>
								<div class="form-check form-check-inline">
									<input type="button" class="btn btn-primary" id="save" name="save"
											value="儲存" @click="saveArticles()">
									</div>
							</slot>
						</div>
					</form>
				</div>
			</div>
		</div>
	</transition>
</template>

<style>
	.modal-container{
		width:480px
	}
</style>

<script>
import swal from "sweetalert"

export default {
	props: {
		editTitle: {
			type:String
		},
		params: {
			type:Object
		},
		urlAdd: {
			type:String
		},
		urlUpdate: {
			type:String
		},
		isAdd: {
			type:Boolean
		}
	},
	data() {
		return {
			title: this.params.title,
			content: this.params.content,
			slug:this.params.slug,
			messageText: '',
		}
	},
	methods: {
		checkArticles(title, content, slug) {
			let isSuccess = false
			this.messageText = ''
			
			if (title === '' && content === '' && slug === '') {
				this.messageText = "標題或文章內容或網址不能為空"
			} else if (title === '') {
				this.messageText = "標題不能為空"
			} else if (content === '') {
				this.messageText = "文章內容不能為空"
			} else if (slug === '') {
				this.messageText = "網址不能為空"
			} 

			if (this.messageText == '') {
				isSuccess = true
			} else {
				this.$emit('is-show-message', isSuccess, this.messageText)
			}
			return isSuccess
		},
		saveArticles(){
			let title = this.title
			let content = this.content
            let slug = this.slug
            let url = this.isAdd ? this.urlAdd : this.urlUpdate
			let isSuccess = this.checkArticles(title, content, slug)

			if (isSuccess) {
				let data = {
					'title': title,
					'content': content,
					'slug': slug
				}

				if (!this.isAdd) {
					data['id'] = this.params.id
				}

				axios.post(url, data).then((response) => {
					let isSuccess = response.data.status == 'success' ? true : false
					if (isSuccess && !this.isAdd) {
						this.$emit('update-articles-data', data)
					}
					this.$emit('is-show-message', isSuccess, response.data.message)
				}).catch((error) => {
					if (error.response) {
						console.log(error.response.data);
						console.log(error.response.status);
						console.log(error.response.headers);
					} else {
						console.log('Error', error.message);
					}

					let ErrorMessage = '新增失敗!'
					if (!this.isAdd) {
						ErrorMessage = '更新失敗!'
					}
					this.$emit('is-show-message', false, ErrorMessage)
				})
			}
			
		}
	},
}
</script>