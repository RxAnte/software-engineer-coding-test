import { useMutation, useQuery, useQueryClient } from '@tanstack/react-query';
import { ToDo } from './ToDo';

const fetchUrl = 'http://localhost:55781/todos';

export const useToDoData = () => useQuery<Array<ToDo>>({
    queryKey: [fetchUrl],
    queryFn: async () => {
        const response = await fetch(fetchUrl);

        return response.json();
    },
});

export const useAddToDoMutation = (onSuccess?: () => void) => {
    const queryClient = useQueryClient();

    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    return useMutation<any, unknown, {
        title: string;
    }>({
        mutationFn: async (params) => fetch(fetchUrl, {
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json',
            },
            method: 'POST',
            body: JSON.stringify(params),
        }),
        onSuccess: async () => {
            // noinspection ES6MissingAwait
            queryClient.invalidateQueries([fetchUrl]);

            if (!onSuccess) {
                return;
            }

            onSuccess();
        },
    });
};
