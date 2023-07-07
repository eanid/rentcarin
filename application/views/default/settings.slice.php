@extends('default.layouts.master')

@section('subtitle')
Modify emails, site title, etc
@endsection

@section('title')
Settings
@endsection

@section('content')
<div class="row row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h3 class="card-title">Global Settings</h3>
                <div class="card-subtitle text-danger">Please <strong>do not change</strong> any of these value without consulting to Administrator</div>
                <hr>

                <div class="mb-3">
                    <?php if($this->session->flashdata('recmsg')): ?>
                    <div class="alert alert-warning alert-dismissible fade show">
                        <?php echo $this->session->flashdata('recmsg'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>                        
                    </div>
                    <?php endif ?>
                </div>

                <?php echo form_open('settings/update'); ?>
                    <?php foreach($posts as $key => $post): ?>

                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label text-end"><?php echo $post->setting_name_alias ?></label>
                            <div class="col-md-<?php echo $post->field_width ?>">
                                <?php if($post->field_type == 'textarea'): ?>
                                    <textarea name="<?php echo $post->setting_name ?>" class="form-control" rows="2"><?php echo $post->setting_value ?></textarea>
                                <?php elseif($post->setting_name == 'caching_type'): ?>
                                    <?php echo form_dropdown($post->setting_name, $cache_type, $post->setting_value,'class="form-control" required'); ?>
                                <?php elseif($post->setting_name == 'ramadhan_season'): ?>
                                    <?php echo form_dropdown($post->setting_name, $ramadhan_season, $post->setting_value,'class="form-control" required'); ?>
                                <?php else: ?>
                                    <input type="<?php echo $post->field_type ?>" name="<?php echo $post->setting_name ?>" placeholder="small" class="form-control" id="<?php echo $post->setting_name ?>" value="<?php echo $post->setting_value ?>">
                                <?php endif ?>
                                <small class="font-hint"><?php echo $post->setting_name_description ?> &mdash; get_setting('<?php echo $post->setting_name ?>')</small>
                            </div>
                        </div>

                    <?php endforeach ?>
                    <div class="mb-4"></div>
                    <div class="form-group mb-3 row">
                        <label class="col-3"></label>
                        <div class="col-md-6">
                            <button type="submit" id="update-setting" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js_init')
<script>
$(function() {
	$('#update-setting').on('click', function() {
        $.blockUI({ 
            message: 'Please wait',
            timeout: 0, //unblock after 2 seconds
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
    });
})
</script>
@endsection