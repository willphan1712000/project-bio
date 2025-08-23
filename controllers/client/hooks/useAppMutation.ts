import { useMutation, useQueryClient } from "@tanstack/react-query"

/**
 * Function creates abstract layer over useMutation in Tanstack Query
 * @param queryKey 
 * @param apiFunc 
 * @returns 
 */
export default function useAppMutation<T extends (...args: any[]) => Promise<any>>(queryKey: string, apiFunc: T) {
    const queryClient = useQueryClient()
    return useMutation<Awaited<ReturnType<T>>, unknown, Parameters<T>[0]>({
        mutationFn: apiFunc,
        onSuccess: () => {
            queryClient.invalidateQueries({ queryKey: [queryKey] })
        }
    })
}