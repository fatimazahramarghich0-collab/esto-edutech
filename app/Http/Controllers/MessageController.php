<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
    }
    public function marquerCommeLu($id) {
        $message = Message::findOrFail($id);
        $message->estLu = true;
        $message->save();
        return response()->json(['message' => $message->message]);
    }

    public function deleteAll()
    {
        // Supprimer tous les messages de la table "messages"
        Message::truncate();

        // Retourner une réponse JSON pour indiquer que la suppression a réussi
        return response()->json(['message' => 'Tous les messages ont été supprimés avec succès.']);
    }

    public function getUnreadMessages() {
        $unreadMessages = Message::where('estLu', false)->paginate(6);
        return response()->json(['messages' => $unreadMessages]);
    }

    public function deleteReadMessages()
    {
        Message::where('estLu', true)->delete();
        return response()->json(['success' => true]);
    }

}
