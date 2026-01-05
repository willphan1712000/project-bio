import { useQuery } from '@tanstack/react-query';

/**
 * Function creates abstract layer over useQuery in tanstack query
 * @param queryKey
 * @param apiFunc
 * @returns
 */
export default function useAppQuery<T extends () => Promise<any>>(
    queryKey: string,
    apiFunc: T
) {
    return useQuery<Awaited<ReturnType<T>>>({
        queryKey: [queryKey],
        queryFn: async () => apiFunc(),
        staleTime: 5 * 60 * 1000, // 5 minutes,
        retry: 3,
    });
}
