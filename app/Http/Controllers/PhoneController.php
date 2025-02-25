<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePhoneRequest;
use App\Models\Phone;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PhoneController extends Controller
{

    /**
     * Obtém os telefones registados no sistema
     *
     * @param Request $request
     * @return void
     */
    public function getData(Request $request): JsonResponse
    {
        $phones = Phone::orderBy("updated_at", "desc")->get();
        return response()->json($phones);
    }

    /**
     * Salva uma nova linha telefônica no banco
     *
     * @param StoreUpdatePhoneRequest $request
     * @return JsonResponse
     */
    public function store(StoreUpdatePhoneRequest $request): JsonResponse
    {
        try {

            Phone::create([
                'phone' => $request->phone,
                'monthly_price' => $request->monthly_price,
                'setup_price' => $request->setup_price,
                'amount' => $request->amount,
                'currency' => $request->currency,
            ]);

            return response()->json("Linha telefônica registrada com sucesso!");

        } catch (Exception $e) {
            Log::error("[PhoneController-store] Houve um erro ao registrar a linha: ".$e->getMessage());
            return response()->json("Ocorreu um problema ao registrar a linha, tente novamente mais tarde ou contate um admnistrador", 500);
        }

    }

    /**
     * Atualiza os dados de uma linha telefônica no banco
     *
     * @param StoreUpdatePhoneRequest $request
     * @return JsonResponse
     */
    public function update(StoreUpdatePhoneRequest $request): JsonResponse
    {

        try {
            $phone = Phone::find($request->id);

            $phone->phone = $request->phone;
            $phone->monthly_price = $request->monthly_price;
            $phone->setup_price = $request->setup_price;
            $phone->currency = $request->currency;

            $phone->save();

            return response()->json("Linha telefônica registrada com sucesso!");

        } catch (Exception $e) {
            Log::error("[PhoneController-store] Houve um erro ao registrar a linha: ".$e->getMessage());
            return response()->json("Ocorreu um problema ao registrar a linha, tente novamente mais tarde ou contate um admnistrador", 500);
        }
    }

    /**
     * Apaga o registro da linha telefônica
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        try {
            $phone = Phone::find($request->id);

            if ($phone) {
                $phone->delete();
                return response()->json("Linha telefônica removida com sucesso!");
            }

            return response()->json("Linha telefônica não encotrada!", 400);

        } catch (Exception $e) {
            Log::error("[PhoneController-store] Houve um erro ao registrar a linha: ".$e->getMessage());
            return response()->json("Ocorreu um problema ao registrar a linha, tente novamente mais tarde ou contate um admnistrador", 500);
        }
    }
}
