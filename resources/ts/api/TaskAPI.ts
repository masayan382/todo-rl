import axios from "axios";
import { Task } from "../pages/types/Task";

const getTasks = async () => {
    const { data } = await axios.get<Task[]>("api/tasks");
    return data;
};

export { getTasks };
