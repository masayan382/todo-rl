import * as api from "../api/TaskAPI";
import { useQuery } from "react-query";

const useTasks = () => {
    return useQuery("tasks", async () => api.getTasks());
};

export { useTasks };
