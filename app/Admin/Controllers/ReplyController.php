<?php

namespace App\Admin\Controllers;

use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReplyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '评论管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Reply);

        $grid->column('id', __('Id'));
        $grid->column('topic_id', __('帖子'))->display(function ($topic_id) {
            return Topic::find($topic_id)->title;
        });
        $grid->column('user_id', __('用户'))->display(function ($user_id) {
            return User::find($user_id)->name;
        });
        $grid->column('content', __('内容'));
        $grid->column('created_at', __('评论时间'));
        $grid->actions(function ($action) {
            $action->disableView();
            $action->disableEdit();
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Reply::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('topic_id', __('Topic id'));
        $show->field('user_id', __('User id'));
        $show->field('content', __('Content'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Reply);

        $form->number('topic_id', __('Topic id'));
        $form->number('user_id', __('User id'));
        $form->textarea('content', __('Content'));

        return $form;
    }
    public function destroy($id)
    {
        Reply::find($id)->delete();
    }
}
