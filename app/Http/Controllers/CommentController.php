<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comments;

class CommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/comments/index');

    }

    public function selectComments()
    {
        $query = Comments::select('id', 'name', 'email', 'comment', 'id_news', 'created_at')->with('news');


        return datatables($query)
            ->order(function ($query) {
                $columns = array(
                    0 => 'name',
                    4 => 'created_at'
                );

                $dir = request()->order[0]['dir'];
                $col =  $columns[intval(request()->order[0]['column'])];

                $query->orderBy($col, $dir);
            })
            ->rawColumns(['actions', 'date', 'news'])
            ->addColumn('actions', 'admin/comments/actions')

            ->addColumn('date', function($query){
                return date('d.m.Y', strtotime($query->created_at));
            })

            ->addColumn('news', function($query){
                return "<a href = '" . route('fullNewsPage', ['news' => $query->news['alias']]) . "' target = '_blank'>" . $query->news['title'] . "</a>";
            })

            ->toJson();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
            'id_news' => 'required',
        ]);

        $input = $request->all();

        $comment = new Comments();
        $comment->fill($input);
        $comment->save();

        $input['date'] = date('d F Y');
        return response()->json([
            'message' => "Сomentariul a fost adăugat",
            'renderComment' => view('partialView/comment', $input)->render()
        ], 201);
    }

    public function delete($id)
    {
        return view('admin/comments/delete', Comments::findOrFail($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comments::findOrFail($id);

        $comment->delete();

        return response()->json([
            'message' => 'Comentariul a fost șters.'
        ], 200);
    }
}
